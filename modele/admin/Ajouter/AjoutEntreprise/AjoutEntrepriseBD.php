<?php

include '../../../connexionBd.php';

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
           
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare("INSERT INTO entreprise (nom_entreprise, tel_entreprise, mail_entreprise, pswd_entreprise)
                VALUES (:NomEntreprise, :phone, :email_inscription, :pwd_inscription)");
            $stmt->bindParam(':NomEntreprise', $nom);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':email_inscription', $email);
            $stmt->bindParam(':pwd_inscription', $pwd);
            $stmt->execute();

        
            
        } catch (PDOException $e) {
            $message = "Echec de l'insertion : " . $e->getMessage();
        }
       
    } else {
        $message = "Les mots de passe ne correspondent pas.";
    }
} else {
    $message = "Toutes les données doivent être renseignées";
}

header("location: projets/geii/view/vues_admin/Admin.php");
exit();
?>
