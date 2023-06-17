<?php

// Récupérer les valeurs du formulaire
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

    // Insertion des données de l'enseignant
    $sql = "INSERT INTO enseignant (nom_enseignant, prenom_enseignant, login_enseignant, pswd_enseignant, id_classe)
            VALUES (:nom, :prenom, :login, :password, :idClasse)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $password);

    // Récupération de l'ID de la classe sélectionnée
    $idClasse = isset($_POST['classes']) ? $_POST['classes'][0] : null;
    $stmt->bindParam(':idClasse', $idClasse);
    $stmt->execute();
    $idEnseignant = $conn->lastInsertId();

    // Insertion des associations entre l'enseignant et les matières
    foreach ($matieres as $matiere) {
        $sql = "INSERT INTO enseignant_matiere (id_enseignant, id_matiere)
                VALUES (:idEnseignant, :matiere)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idEnseignant', $idEnseignant);
        $stmt->bindParam(':matiere', $matiere);
        $stmt->execute();
    }
    // Insertion des associations entre l'enseignant et les classes
foreach ($classes as $classe) {
    $sql = "INSERT INTO enseignant_classe (id_enseignant, id_classe)
            VALUES (:idEnseignant, :classe)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idEnseignant', $idEnseignant);
    $stmt->bindParam(':classe', $classe);
    $stmt->execute();
}
header("location: /geii/view/vues_admin/Admin.php");
} catch (PDOException $e) {
    echo "Erreur lors de la création de l'enseignant: " . $e->getMessage();
}

// Fermeture de la connexion à la base de données
$conn = null;
?>
