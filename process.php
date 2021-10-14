<?php 
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "demo";

    $conn = new mysqli($host, $user, $pass, $dbname);

    if($conn->connect_error){
        die("Connection to DB failed: " . $conn->connect_error);
    }
    else {
        echo "Pripojeno!";
    }


    $stmt = $conn->prepare("INSERT INTO recepty (jmeno, popis, postup, casPripravy, autor) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $nazev, $popis, $postup, $casik, $jmeno);

    $nazev = htmlspecialchars($_POST['nazev'], ENT_QUOTES);
    $popis = htmlspecialchars($_POST['popis'], ENT_QUOTES);
    $postup = htmlspecialchars($_POST['postup'], ENT_QUOTES);
    $casik = htmlspecialchars($_POST['cas'], ENT_QUOTES);
    $jmeno = htmlspecialchars($_POST['jmeno'], ENT_QUOTES);
    
    if($stmt->execute()){
        echo "Vlozeni uspesne";
        #header("Location: ". "http://kucharka.testing/");
    }
    else{
        echo "Nastala chyba: " . mysqli_error($conn);
    }
?>
