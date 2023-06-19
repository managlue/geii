<?php

include 'C:\wamp64\www\projets\geii\modele\connexionBd.php';


if (isset($_GET['etudiant_id'])) {

    $etudiant_id = $_GET['etudiant_id'];
   
    try {

        $stmt = $pdo->prepare("DELETE FROM etudiant WHERE id_etudiant = :etudiant_id");
        $stmt->bindParam(':etudiant_id', $etudiant_id, PDO::PARAM_INT);

        $stmt->execute();
        echo "<p>Suppression(s) effectuée(s) : " . $stmt->rowCount() . "</p>\n";


    } catch (PDOException $e) {
        
        echo "<p>Echec de la suppression : " . $e->getMessage() ."</p>\n";
       
    }

    header("location: /geii/view/vues_admin/Admin.php");
    exit();
}
