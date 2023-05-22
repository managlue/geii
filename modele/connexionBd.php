<?php
    $host = "localhost";
    $dbname = "id20742082_geii";
    $user = "id20742082_projetinfogeii";
    $pass = "C1pw4proj@";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        die();
    }
?>