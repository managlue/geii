<?php
// Récupérer les valeurs du formulaire
$idEnseignant = $_POST['idEnseignant'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$login = $_POST['login'];
$password = $_POST['password'];
$classes = $_POST['classes'];
$matieres = $_POST['matieres'];

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "test";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /// Mise à jour des données de l'enseignant
$sql = "UPDATE enseignant SET nom_enseignant = :nom, prenom_enseignant = :prenom, login_enseignant = :login, pswd_enseignant = :password, id_classe = :idClasse WHERE id_enseignant = :idEnseignant";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':prenom', $prenom);
$stmt->bindParam(':login', $login);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':idClasse', $idClasse); // Assurez-vous de définir correctement $idClasse avec la valeur de la classe appropriée
$stmt->bindParam(':idEnseignant', $idEnseignant);
$stmt->execute();

    // Suppression des anciennes associations entre l'enseignant et les matières
    $sqlDeleteMatieres = "DELETE FROM enseignant_matiere WHERE id_enseignant = :idEnseignant";
    $stmtDeleteMatieres = $conn->prepare($sqlDeleteMatieres);
    $stmtDeleteMatieres->bindParam(':idEnseignant', $idEnseignant);
    $stmtDeleteMatieres->execute();

    // Insertion des nouvelles associations entre l'enseignant et les matières
    foreach ($matieres as $matiere) {
        $sqlInsertMatiere = "INSERT INTO enseignant_matiere (id_enseignant, id_matiere) VALUES (:idEnseignant, :matiere)";
        $stmtInsertMatiere = $conn->prepare($sqlInsertMatiere);
        $stmtInsertMatiere->bindParam(':idEnseignant', $idEnseignant);
        $stmtInsertMatiere->bindParam(':matiere', $matiere);
        $stmtInsertMatiere->execute();
    }

    // Suppression des anciennes associations entre l'enseignant et les classes
    $sqlDeleteClasses = "DELETE FROM enseignant_classe WHERE id_enseignant = :idEnseignant";
    $stmtDeleteClasses = $conn->prepare($sqlDeleteClasses);
    $stmtDeleteClasses->bindParam(':idEnseignant', $idEnseignant);
    $stmtDeleteClasses->execute();

    // Insertion des nouvelles associations entre l'enseignant et les classes
    foreach ($classes as $classe) {
        $sqlInsertClasse = "INSERT INTO enseignant_classe (id_enseignant, id_classe) VALUES (:idEnseignant, :classe)";
        $stmtInsertClasse = $conn->prepare($sqlInsertClasse);
        $stmtInsertClasse->bindParam(':idEnseignant', $idEnseignant);
        $stmtInsertClasse->bindParam(':classe', $classe);
        $stmtInsertClasse->execute();
    }

    echo "Enseignant modifié avec succès!";
} catch (PDOException $e) {
    echo "Erreur lors de la modification de l'enseignant: " . $e->getMessage();
}

// Fermeture de la connexion à la base de données
$conn = null;
?>
