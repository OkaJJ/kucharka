<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>

    <?php 

    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "demo";

    $db_status = 2;

    preg_match("/.+(\/.+)$/", $_SERVER["HTTP_REFERER"], $match);

    if(isset($match[1]) && $match[1] == $_SERVER["REQUEST_URI"] && count($_POST) != 0){
        
        $conn = new mysqli($host, $user, $pass, $dbname);
        if($conn->connect_error){
            $db_status = -1;
            die("Connection to DB failed: " . $conn->connect_error);
        }

        if($_POST['cas'] > 120){
            $_POST['cas'] = 120;
        } elseif($_POST['cas'] < 10){
            $_POST['cas'] = 10;
        }

        $stmt = $conn->prepare("INSERT INTO recepty (jmeno, popis, postup, casPripravy, autor) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $nazev, $popis, $postup, $casik, $jmeno);

        $nazev = htmlspecialchars($_POST['nazev'], ENT_QUOTES);
        $popis = htmlspecialchars($_POST['popis'], ENT_QUOTES);
        $postup = htmlspecialchars($_POST['postup'], ENT_QUOTES);
        $casik = htmlspecialchars($_POST['cas'], ENT_QUOTES);
        $jmeno = htmlspecialchars($_POST['jmeno'], ENT_QUOTES);
        
        if($stmt->execute()){
            $db_status = 1;
            #header("Location: ". "http://kucharka.testing/");
        }
        else{
            $db_status = 0;
        }
    }
    ?>

</head>
<body>
    <?php include "web_parts/header.php"?>
    <main>
    <h1>Přidání receptu</h1>
    <form action="add_recipe.php" method="POST">
        <fieldset>
            <legend>Hlavní informace</legend>
            <div>
                <label for="nazev">Název receptu</label>
                <input type="text" name="nazev" id="nazev" required>
            </div>
            <div>
                <label for="popis">Krátký popis receptu</label>
                <input type="text" name="popis" id="popis" required>
            </div>
        </fieldset>
        <fieldset>
            <legend>Postup receptu</legend>
            <div>
                <label for="postup">Postup receptu</label>
                <textarea name="postup" id="postup" cols="50" rows="5" required></textarea>
            </div>
            <div>
                <label for="cas">Čas připravy</label>
                <input type="number" name="cas" id="cas" placeholder="(v minutách)" min="10" max="600" title="Musí být v rozsahu od 10 do 600 minut" required>
            </div>
            <div>
                <label for="jmeno">Autor</label>
                <input type="text" name="jmeno" id="jmeno" required>
            </div>
        </fieldset>
        <div class="submit-btn">
            <input type="submit" value="Odeslat">
        </div>

        <div class="notif-box">
            <?php 
                switch($db_status){
                    case -1:
                    case 0:
                        echo "<div class='fail'><p>Nepodařilo se vložit do databáze :(</p></div>";
                        break;
                    case 1:
                        echo "<div class='pass'><p class='pass'>Vložení úspěšné :)</p></div>";            
                        break;
                }
            ?>
        </div>

    </form>
    </main>
    <?php include "web_parts/footer.php"?>
</body>
</html>