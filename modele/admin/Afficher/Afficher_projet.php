<?php

include '../../modele/connexionBd.php';

    try {
      $stmt = $pdo->prepare("SELECT titre_projet_tut FROM projet_tut");
      $stmt->execute();
      $projets = $stmt->fetchAll(PDO::FETCH_COLUMN);
     
    } catch (PDOException $e) {
      $message = "Echec de la récupération des éléments : " . $e->getMessage();
    }
  
?>
