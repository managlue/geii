<?php

include 'C:\wamp64\www\projets\geii\modele\connexionBd.php';

    try {
     
      $stmt = $pdo->prepare("SELECT titre_offre FROM offre_alternance");
      $stmt->execute();
      $offres = $stmt->fetchAll(PDO::FETCH_COLUMN);
     
    } catch (PDOException $e) {
      $message = "Echec de la récupération des éléments : " . $e->getMessage();
    }
  
?>
