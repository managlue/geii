<?php
session_start();
$host = "localhost";
$dbname = "id20742082_geii";
$user = "root";
$pass = "";

if (isset($_POST['NomEntreprise']) && isset($_POST['email_inscription']) && isset($_POST['phone']) && isset($_POST['pwd_inscription']) && isset($_POST['confirm_pwd'])) {
    $nom = $_POST['NomEntreprise'];
    $email = $_POST['email_inscription'];
    $phone = $_POST['phone'];
    $pwd = $_POST['pwd_inscription'];
    $confirmPwd = $_POST['confirm_pwd'];
    $message = "";

    

    if ($pwd === $confirmPwd) {
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("INSERT INTO entreprise (nom_entreprise, tel_entreprise, mail_entreprise, pswd_entreprise)
                VALUES (:NomEntreprise, :phone, :email_inscription, :pwd_inscription)");
            $stmt->bindParam(':NomEntreprise', $nom);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':email_inscription', $email);
            $stmt->bindParam(':pwd_inscription', $pwd);
            $stmt->execute();

            // Récupérer l'ID de l'entreprise nouvellement inscrite
            $entrepriseId = $conn->lastInsertId();

            // Stocker l'ID de l'entreprise dans la session
            $_SESSION['id_entreprise'] = $entrepriseId;
            $_SESSION['nom_entreprise'] = $nom;

            // Rediriger l'utilisateur vers la page d'accueil
            header("location:/geii/view/AccueilEntreprise.php");
            exit();
        } catch (PDOException $e) {
            $message = "Echec de l'insertion : " . $e->getMessage();
        }
        $conn = null;
    } else {
        $message = "Les mots de passe ne correspondent pas.";
    }
} else {
    $message = "Toutes les données doivent être renseignées";
}
?>
