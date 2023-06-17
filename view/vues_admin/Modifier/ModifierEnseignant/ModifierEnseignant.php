<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "test";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des informations de l'enseignant à modifier
    $idEnseignant = $_GET['id']; // Supposons que vous récupérez l'ID de l'enseignant à modifier depuis l'URL

    // Requête pour récupérer les informations de l'enseignant
    $stmt = $conn->prepare("SELECT * FROM enseignant WHERE id_enseignant = :idEnseignant");
    $stmt->bindParam(':idEnseignant', $idEnseignant);
    $stmt->execute();
    $enseignant = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$enseignant) {
        echo "Enseignant non trouvé.";
        exit;
    }

    // Récupération des classes et matières associées à l'enseignant
    $stmtClasses = $conn->prepare("SELECT id_classe FROM enseignant_classe WHERE id_enseignant = :idEnseignant");
    $stmtClasses->bindParam(':idEnseignant', $idEnseignant);
    $stmtClasses->execute();
    $enseignantClasses = $stmtClasses->fetchAll(PDO::FETCH_COLUMN);

    $stmtMatieres = $conn->prepare("SELECT id_matiere FROM enseignant_matiere WHERE id_enseignant = :idEnseignant");
    $stmtMatieres->bindParam(':idEnseignant', $idEnseignant);
    $stmtMatieres->execute();
    $enseignantMatieres = $stmtMatieres->fetchAll(PDO::FETCH_COLUMN);

    // Formulaire de modification
    ?>
    <form method="post" action="ModifierEnseignantBD.php">
        <input type="hidden" name="idEnseignant" value="<?php echo $enseignant['id_enseignant']; ?>">

        <label for="nom">Nom :</label>
        <input type="text" name="nom" value="<?php echo $enseignant['nom_enseignant']; ?>">

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" value="<?php echo $enseignant['prenom_enseignant']; ?>">

        <label for="login">Login :</label>
        <input type="text" name="login" value="<?php echo $enseignant['login_enseignant']; ?>">

        <label for="password">Mot de passe :</label>
        <input type="password" name="password">

        <label for="classes">Classes :</label>
        <select name="classes[]" multiple>
            <?php
            // Récupération des classes disponibles
            $stmt = $conn->prepare("SELECT * FROM classe");
            $stmt->execute();
            $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Affichage des options
            foreach ($classes as $classe) {
                $selected = in_array($classe['id_classe'], $enseignantClasses) ? 'selected' : '';
                echo '<option value="' . $classe['id_classe'] . '" ' . $selected . '>' . $classe['nom_classe'] . '</option>';
            }
            ?>
        </select>

        <label for="matieres">Matières :</label>
        <select name="matieres[]" multiple>
            <?php
            // Récupération des matières disponibles
            $stmt = $conn->prepare("SELECT * FROM matiere");
            $stmt->execute();
            $matieres = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Affichage des options
            foreach ($matieres as $matiere) {
                $selected = in_array($matiere['id_matiere'], $enseignantMatieres) ? 'selected' : '';
                echo '<option value="' . $matiere['id_matiere'] . '" ' . $selected . '>' . $matiere['nom_matiere'] . '</option>';
            }
            ?>
        </select>

        <input type="submit" value="Modifier">
    </form>
    <?php

} catch (PDOException $e) {
    echo "Erreur lors de la récupération des données de l'enseignant: " . $e->getMessage();
}

// Fermeture de la connexion à la base de données
$conn = null;
?>
