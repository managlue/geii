<?php
if (isset($_POST['email'])) {
    $email = $_POST['email'];
            $sujet = "Exemple d'e-mail automatique";

            // Contenu du mail
            $message = "Bonjour,\n\nCeci est un exemple d'e-mail automatique envoyé depuis mon script PHP.\n\nCordialement,\nVotre Nom";

            // En-têtes du mail
            $headers = "From: projetinfogeii@gmail.com\r\n";
            $headers .= "Reply-To: moussisidahmed0@gmail.com \r\n";
            $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

            // Envoi de l'e-mail
            if (mail($destinataire, $sujet, $message, $headers)) {
                echo "L'e-mail a été envoyé avec succès.";
            } else {
                echo "Une erreur s'est produite lors de l'envoi de l'e-mail.";
            }

            ?>