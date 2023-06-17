<?php

    try {
        $conn = new PDO("mysql:host=localhost;dbname=test", 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT titre_offre FROM offre_alternance");
      $stmt->execute();
      $offres = $stmt->fetchAll(PDO::FETCH_COLUMN);
     
    } catch (PDOException $e) {
      $message = "Echec de la récupération des éléments : " . $e->getMessage();
    }
  
?>
