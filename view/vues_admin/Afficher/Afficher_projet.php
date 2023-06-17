<?php

    try {
        $conn = new PDO("mysql:host=localhost;dbname=test", 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT titre_projet_tut FROM projet_tut");
      $stmt->execute();
      $projets = $stmt->fetchAll(PDO::FETCH_COLUMN);
     
    } catch (PDOException $e) {
      $message = "Echec de la récupération des éléments : " . $e->getMessage();
    }
  
?>
