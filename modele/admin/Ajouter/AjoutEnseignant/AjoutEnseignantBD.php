<?php

include '../../../connexionBd.php';

// Récupérer les valeurs du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$login = $_POST['login'];
$password = $_POST['password'];
$classes = $_POST['classes'];
$matieres = $_POST['matieres'];


try {
   
    // Insertion des données de l'enseignant
    $sql = "INSERT INTO enseignant (nom_enseignant, prenom_enseignant, login_enseignant, pswd_enseignant, id_classe)
            VALUES (:nom, :prenom, :login, :password, :idClasse)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $password);

    // Récupération de l'ID de la classe sélectionnée
    $idClasse = isset($_POST['classes']) ? $_POST['classes'][0] : null;
    $stmt->bindParam(':idClasse', $idClasse);
    $stmt->execute();
    $idEnseignant = $pdo->lastInsertId();

    // Insertion des associations entre l'enseignant et les matières
    foreach ($matieres as $matiere) {
        $sql = "INSERT INTO enseignant_matiere (id_enseignant, id_matiere)
                VALUES (:idEnseignant, :matiere)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idEnseignant', $idEnseignant);
        $stmt->bindParam(':matiere', $matiere);
        $stmt->execute();
    }
    // Insertion des associations entre l'enseignant et les classes
foreach ($classes as $classe) {
    $sql = "INSERT INTO enseignant_classe (id_enseignant, id_classe)
            VALUES (:idEnseignant, :classe)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idEnseignant', $idEnseignant);
    $stmt->bindParam(':classe', $classe);
    $stmt->execute();
}

} catch (PDOException $e) {
    echo "Erreur lors de la création de l'enseignant: " . $e->getMessage();
}


header("location: /geii/view/vues_admin/Admin.php");
?>
