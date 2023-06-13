<?php

include '../../modele/connexionBd.php';

if (isset($_GET['id'])) {
    $offre_id = $_GET['id'];

    try {
   
        $stmt = $pdo->prepare("DELETE FROM offre_alternance WHERE id_offre = :id");
        $stmt->bindParam(':id', $offre_id, PDO::PARAM_INT);
        $stmt->execute();
        echo '<script>';
        echo 'alert("L\'offre a été supprimée avec succès !");';
        echo '</script>';

    } catch (PDOException $e) {
        
        echo '<script>';
        echo 'alert("Échec de la suppression de l\'offre !");';
        echo '</script>';
       
    }

    header("location: /geii/view/vues_entreprise/AfficherOffreBD.php");
    exit();
}
?>