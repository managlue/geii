<?php
$id = $_GET['id'];

// Vérifier si l'ID existe dans la base de données
// Connexion à la base de données en utilisant PDO
$host = "localhost";
$dbname = "id20742082_geii";
$user = "root";
$pass = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour vérifier si l'ID existe
    $stmt = $conn->prepare("SELECT id_entreprise FROM entreprise WHERE id_entreprise = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $rowCount = $stmt->rowCount();

    if ($rowCount == 0) {
        echo '<script>alert("L\'utilisateur avec l\'ID '.$id.' n\'existe pas.")</script>';
    } else {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_entreprise = $row['id_entreprise'];

        // echo "La valeur de id_entreprise est : " . $id_entreprise;

        if (isset($_POST['pwd_inscription']) && isset($_POST['confirm_pwd'])) {
            // Récupérer les nouveaux mots de passe depuis le formulaire
            $newPassword = $_POST['pwd_inscription'];
            $confirmPassword = $_POST['confirm_pwd'];

            if ($newPassword === $confirmPassword) {
                // Crypter le mot de passe
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Mettre à jour le mot de passe de l'utilisateur
                $updateStmt = $conn->prepare("UPDATE entreprise SET pswd_entreprise = :pwd_inscription WHERE id_entreprise = :id");
                $updateStmt->bindParam(':pwd_inscription', $hashedPassword);
                $updateStmt->bindParam(':id', $id);
                $updateStmt->execute();

                echo "Le mot de passe a été mis à jour avec succès.";
            } else {
                echo "Les mots de passe ne correspondent pas.";
            }
        }
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulaire de mise à jour du mot de passe</title>
    <link rel="stylesheet" href="../../css/Entreprise_CSS/style.css">  
</head>
<body>
    
    <div class="container">
<div class="form-section">
    <form method="POST" action="ChangerMotDePasse.php?id=<?php echo $id; ?>">
    <div class="login-box">
    <input type="password" class="password ele" id="pwd_inscription" name="pwd_inscription" placeholder="Nouveau mot de passe" required="required">
				<input type="password" class="password ele" id ="confirm_pwd" name="confirm_pwd" placeholder="Confirmez le mot de passe" required="required">
        <br>
        <button type="submit" name="sendMailBtn" href ="co.php" class="clkbtn">Modifier</button>
    </div>
    </form>
</div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</body>
</html>
