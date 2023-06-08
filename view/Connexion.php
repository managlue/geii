<?php
session_start();
$host = "localhost";
$dbname = "id20742082_geii";
$user = "root";
$pass = "";
$error_message = "";

if (isset($_POST['email']) && isset($_POST['pwd'])) {
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    try {
        // Connexion à la base de données
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recherche de l'utilisateur dans la base de données
        $stmt = $conn->prepare("SELECT id_entreprise, nom_entreprise, pswd_entreprise FROM entreprise WHERE mail_entreprise = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch();

        // Vérification de l'e-mail et du mot de passe
        if (!$result) {
            // Afficher un message d'erreur si l'e-mail n'existe pas
            $error_message = "Mauvais identifiant !";
            echo $error_message;
        } else {
            $isPasswordCorrect = password_verify($password, $result['pswd_entreprise']);
         
            if (!$isPasswordCorrect) {
                // Afficher un message d'erreur si le mot de passe est incorrect
                $error_message = "Mauvais mot de passe !";
                echo $error_message;
            } else {
                // Démarre la session pour l'utilisateur
                $_SESSION['id_entreprise'] = $result['id_entreprise'];
                $_SESSION['nom_entreprise'] = $result['nom_entreprise'];
                // var_dump($result['nom_entreprise']);
              
                header("Location: /geii/view/AccueilEntreprise.php");
                exit();
            }
        }
    } catch (PDOException $e) {
        $error_message = "Echec de l'affichage : " . $e->getMessage();
        echo $error_message;
    }
  
    $conn = null;
}
?>
