<?php
session_start();
include '../../../modele/connexionBd.php';

$error_message = "";

if (isset($_POST['identifiant']) && isset($_POST['password'])) {
    $identifiant = $_POST['identifiant'];
    $password = $_POST['password'];

    try {


        $stmt = $pdo->prepare("SELECT pswd_admin FROM admin WHERE identifiant_admin = :identifiant");
        $stmt->bindParam(':identifiant', $identifiant);
        $stmt->execute();

        $result = $stmt->fetch();

        // Vérification de l'identifiant et du mot de passe
        if (!$result) {
            // Identifiant incorrect
            $error_message = "Identifiant ou mot de passe incorrect";
            echo $error_message;
        } else {
            $hashedPassword = $result['pswd_admin'];
            $isPasswordCorrect = password_verify($password, $hashedPassword);

            if (!$isPasswordCorrect) {
                // Mot de passe incorrect
                $error_message = "Identifiant ou mot de passe incorrect";
                echo $error_message;
            } else {
                // Authentification réussie
                $_SESSION['identifiant'] = $identifiant;
                header("Location: /geii/view/vues_admin/Admin.php");
                exit();
            }
        }
    } catch (PDOException $e) {
        // Erreur de connexion à la base de données
        $error_message = "Erreur lors de la connexion à la base de données";
        echo $error_message;
    }
}
?>