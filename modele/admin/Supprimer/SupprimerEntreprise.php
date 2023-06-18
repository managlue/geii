<?php

include 'C:\wamp64\www\projets\geii\modele\connexionBd.php';


if (isset($_GET['entreprise_id'])) {

    $entreprise_id = $_GET['entreprise_id'];
   
    try {

        $stmt = $pdo->prepare("DELETE FROM entreprise WHERE id_entreprise = :entreprise_id");
        $stmt->bindParam(':entreprise_id', $entreprise_id, PDO::PARAM_INT);

        $stmt->execute();
        echo "<p>Suppression(s) effectuée(s) : " . $stmt->rowCount() . "</p>\n";


    } catch (PDOException $e) {
        
        echo "<p>Echec de la suppression : " . $e->getMessage() ."</p>\n";
       
    }

    header("location: /geii/view/vues_admin/Admin.php");
    exit();
}
?>