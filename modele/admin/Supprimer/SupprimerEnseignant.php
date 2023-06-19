<?php

include 'C:\wamp64\www\projets\geii\modele\connexionBd.php';


// Récupérer l'ID de l'enseignant à supprimer
$idEnseignant = $_GET['enseignant_id'];

try {
    // Suppression des entrées correspondantes dans la table enseignant_matiere
    $sqlDeleteMatiere = "DELETE FROM enseignant_matiere WHERE id_enseignant = :idEnseignant";
    $stmtDeleteMatiere = $pdo->prepare($sqlDeleteMatiere);
    $stmtDeleteMatiere->bindParam(':idEnseignant', $idEnseignant);
    $stmtDeleteMatiere->execute();

    // Suppression des entrées correspondantes dans la table enseignant_classe
    $sqlDeleteClasse = "DELETE FROM enseignant_classe WHERE id_enseignant = :idEnseignant";
    $stmtDeleteClasse = $pdo->prepare($sqlDeleteClasse);
    $stmtDeleteClasse->bindParam(':idEnseignant', $idEnseignant);
    $stmtDeleteClasse->execute();

    // Suppression de l'enseignant
    $sqlDeleteEnseignant = "DELETE FROM enseignant WHERE id_enseignant = :idEnseignant";
    $stmtDeleteEnseignant = $pdo->prepare($sqlDeleteEnseignant);
    $stmtDeleteEnseignant->bindParam(':idEnseignant', $idEnseignant);
    $stmtDeleteEnseignant->execute();

   
 
} catch (PDOException $e) {
    echo "Erreur lors de la suppression de l'enseignant: " . $e->getMessage();
}

// Fermeture de la connexion à la base de données
$pdo = null;
header("location: /geii/view/vues_admin/Admin.php");
?>
