<?php
  
  include '/geii/modele/connexionBd.php';

  $mdp = password_hash('admin', PASSWORD_DEFAULT);
  
  $sql = "INSERT INTO admin (identifiant_admin, pswd_admin) 
    VALUES ('admin', :mdp);";

  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':mdp', $mdp);
  $stmt->execute();
  ?>