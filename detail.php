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

    if($conn->connect_error){
        die("Connection to DB failed: " . $conn->connect_error);
    }

    include "web_parts/header.php";
    
    echo "<main id='page-detail'>";

    $sql = "SELECT id, jmeno, postup, casPripravy, autor, popis FROM recepty WHERE id = {$_GET['recipe-id']}";
    $result = $conn->query($sql);

    if ($result !== false) {
        $result = $result->fetch_assoc();
        echo "<h1>{$result['jmeno']}</h1>";
        echo "<h2>{$result['popis']}</h2>";
        echo "<h3><strong>Postup receptu</strong></h3><p>{$result['postup']}</p>";
        echo "<h3><strong>Čas přípravy</strong> {$result['casPripravy']} minut</h3>";
        echo "<h3>Autor receptu <strong>{$result['autor']}</strong></h3>";
    }

    echo "<h3 style='margin-top: 20px;'>Jdi <a href='browse.php'>zpatky</a> bracho</h3></main>";
    include "web_parts/footer.php";
?>
    
</body>
</html>