<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
<?php 
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "demo";

    $conn = new mysqli($host, $user, $pass, $dbname);

    if(isset($_GET['page'])){
        $act_page = $_GET['page'];
    } else {
        $act_page = 1;
    }
    $page_limit = 100;

    if($conn->connect_error){
        die("Connection to DB failed: " . $conn->connect_error);
    }

    include "web_parts/header.php";

    echo "<main>";

    $delka = $conn->query("SELECT COUNT(*) FROM recepty");
    $delka = intval(($delka->fetch_assoc())["COUNT(*)"]);

    $sql = "SELECT id, jmeno, postup, autor, popis FROM recepty ORDER BY id DESC LIMIT $page_limit";
    
    $result = $conn->query($sql);

    if ($result !== false && $result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<a href='detail.php?recipe-id={$row['id']}'><div class='recept-item'><h2>{$row['jmeno']}</h2><p>{$row["popis"]}</p><p>Autor <strong>{$row["autor"]}</strong></p></div></a>";
        }
      } else {
        echo "0 results";
      }
      if($result !== false){
         echo "<div class='browse-goback'><p>Zobrazeno <strong>" . mysqli_num_rows($result) . "</strong> řádků</p><p>Vrátit se na <strong><a href='index.php'>hlavní stránku</a></strong></p></div>";
        }
    
    echo "</main>";
    
    include "web_parts/footer.php"
?>
</body>
</html>