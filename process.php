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


    $nazev = $_POST['nazev'];
    $popis = $_POST['popis'];
    $postup = $_POST['postup'];
    $casik = $_POST['cas'];
    $jmeno = $_POST['jmeno'];

    $query = "INSERT INTO recepty (jmeno, popis, postup, casPripravy, autor) VALUES ('$nazev', '$popis', '$postup', '$casik', '$jmeno')";
    if(mysqli_query($conn, $query)){
        echo "Vlozeni uspesne";
        header("Location: ". "http://kucharka.testing/");
    }
    else{
        echo "Nastala chyba: " . mysqli_error($conn);
    }
?>
