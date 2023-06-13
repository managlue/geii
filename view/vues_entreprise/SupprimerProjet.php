<?php

include '../../modele/connexionBd.php';

if (isset($_GET['id'])) {
    $offre_id = $_GET['id'];

    try {
       
        $stmt = $pdo->prepare("DELETE FROM projet_tut WHERE id_projet_tut = :id");
        $stmt->bindParam(':id', $offre_id, PDO::PARAM_INT);
        $stmt->execute();
        echo '<script>';
        echo 'alert("Le Projet tutoré a été supprimée avec succès !");';
        echo '</script>';

    } catch (PDOException $e) {
        
        echo '<script>';
        echo 'alert("Échec de la suppression de l\'offre !");';
        echo '</script>';
       
    }

    header("location: /geii/view/vues_entreprise/AfficherProjet.php");
    exit();
}
?>