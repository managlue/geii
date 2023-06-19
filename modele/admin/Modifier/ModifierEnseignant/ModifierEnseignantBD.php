<?php

include '../../../connexionBd.php';

// Récupérer les valeurs du formulaire
$idEnseignant = $_POST['idEnseignant'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$login = $_POST['login'];
$password = $_POST['password'];
$classes = $_POST['classes'];
$matieres = $_POST['matieres'];



try {

    /// Mise à jour des données de l'enseignant
$sql = "UPDATE enseignant SET nom_enseignant = :nom, prenom_enseignant = :prenom, login_enseignant = :login, pswd_enseignant = :password, id_classe = :idClasse WHERE id_enseignant = :idEnseignant";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':prenom', $prenom);
$stmt->bindParam(':login', $login);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':idClasse', $idClasse); // Assurez-vous de définir correctement $idClasse avec la valeur de la classe appropriée
$stmt->bindParam(':idEnseignant', $idEnseignant);
$stmt->execute();

    // Suppression des anciennes associations entre l'enseignant et les matières
    $sqlDeleteMatieres = "DELETE FROM enseignant_matiere WHERE id_enseignant = :idEnseignant";
    $stmtDeleteMatieres = $pdo->prepare($sqlDeleteMatieres);
    $stmtDeleteMatieres->bindParam(':idEnseignant', $idEnseignant);
    $stmtDeleteMatieres->execute();

    // Insertion des nouvelles associations entre l'enseignant et les matières
    foreach ($matieres as $matiere) {
        $sqlInsertMatiere = "INSERT INTO enseignant_matiere (id_enseignant, id_matiere) VALUES (:idEnseignant, :matiere)";
        $stmtInsertMatiere = $pdo->prepare($sqlInsertMatiere);
        $stmtInsertMatiere->bindParam(':idEnseignant', $idEnseignant);
        $stmtInsertMatiere->bindParam(':matiere', $matiere);
        $stmtInsertMatiere->execute();
    }

    // Suppression des anciennes associations entre l'enseignant et les classes
    $sqlDeleteClasses = "DELETE FROM enseignant_classe WHERE id_enseignant = :idEnseignant";
    $stmtDeleteClasses = $pdo->prepare($sqlDeleteClasses);
    $stmtDeleteClasses->bindParam(':idEnseignant', $idEnseignant);
    $stmtDeleteClasses->execute();

    // Insertion des nouvelles associations entre l'enseignant et les classes
    foreach ($classes as $classe) {
        $sqlInsertClasse = "INSERT INTO enseignant_classe (id_enseignant, id_classe) VALUES (:idEnseignant, :classe)";
        $stmtInsertClasse = $pdo->prepare($sqlInsertClasse);
        $stmtInsertClasse->bindParam(':idEnseignant', $idEnseignant);
        $stmtInsertClasse->bindParam(':classe', $classe);
        $stmtInsertClasse->execute();
    }

} catch (PDOException $e) {
    echo "Erreur lors de la modification de l'enseignant: " . $e->getMessage();
}

// Fermeture de la connexion à la base de données
$pdo = null;
header("location: /geii/view/vues_admin/Admin.php");

?>
