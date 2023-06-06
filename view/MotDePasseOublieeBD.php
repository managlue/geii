<?php
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
require '../PHPMailer-master/src/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;




// Création d'une nouvelle instance de PHPMailer
$mail = new PHPMailer(true);

try {
    // Paramètres du serveur d'e-mail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Serveur SMTP (par exemple, smtp.gmail.com pour Gmail)
    $mail->SMTPAuth = false;  // Désactiver l'authentification SMTP
    $mail->SMTPAutoTLS = true;  // Activer le chiffrement TLS automatique
    $mail->Port = 25;

    // Destinataire et expéditeur
    $mail->setFrom('moussisidahmed0@gmail.com', 'Votre Nom');
    $mail->addAddress('moussisidahmed0@gmail.com', 'Nom du destinataire');

    // Contenu de l'e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Exemple d\'e-mail sans SMTP';
    $mail->Body = 'Bonjour,<br><br>Ceci est un exemple d\'e-mail envoyé sans utiliser de serveur SMTP.<br><br>Cordialement,<br>Votre Nom';

    // Envoi de l'e-mail
    $mail->send();
    echo 'L\'e-mail a été envoyé avec succès.';
} catch (Exception $e) {
    echo 'Une erreur s\'est produite lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test d'envoi d'e-mail</title>
</head>

<body>
    <h1>Test d'envoi d'e-mail</h1>
    <form method="post" action="">
        <button type="submit" name="send">Envoyer l'e-mail</button>
    </form>
</body>

</html>