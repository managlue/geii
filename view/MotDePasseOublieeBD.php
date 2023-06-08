<?php
if (isset($_POST['sendMailBtn'])) {
    $toEmail = $_POST['toEmail'];

    // Connexion à la base de données en utilisant PDO
    $host = "localhost";
    $dbname = "id20742082_geii";
    $user = "root";
    $pass = "";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête pour récupérer l'adresse e-mail de l'entreprise connectée
        $stmt = $conn->prepare("SELECT id_entreprise, mail_entreprise FROM entreprise WHERE mail_entreprise = :toEmail");
        $stmt->bindParam(':toEmail', $toEmail);
        $stmt->execute();
        $entreprise = $stmt->fetch();

        if ($entreprise) {
            $email_entreprise = $entreprise['mail_entreprise'];
            $entreprise_id = $entreprise['id_entreprise'];

            if ($toEmail === $email_entreprise) {
                // L'adresse e-mail saisie correspond à l'adresse e-mail de l'entreprise connectée, on peut envoyer l'e-mail
                $fromEmail = "moussisidahmed0@gmail.com";
                $message = "Veuillez trouver ci-joint le lien de réinitialisation du mot de passe : 
                <a href='http://projets/geii/view/ChangerMotDePasse.php?id=$entreprise_id'>http://projets/geii/view/ChangerMotDePasse.php?id=$entreprise_id</a>";

                $to = $toEmail;
                $subject = "Réinitialisation du mot de passe";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: '.$fromEmail.'<'.$fromEmail.'>' . "\r\n".'Reply-To: '.$fromEmail."\r\n" . 'X-Mailer: PHP/' . phpversion();

                $result = mail($to, $subject, $message, $headers);

                if ($result) {
                    echo '<script>alert("E-mail envoyé avec succès !")</script>';
                    echo '<script>window.location.href="co.php";</script>';
                } else {
                    echo '<script>alert("Une erreur s\'est produite lors de l\'envoi de l\'e-mail.")</script>';
                }
            } else {
                echo '<script>alert("L\'adresse e-mail saisie ne correspond pas à l\'adresse e-mail de l\'entreprise connectée.")</script>';
            }
        } else {
            echo '<script>alert("Adresse e-mail de l\'entreprise non trouvée dans la base de données.")</script>';
        }
    } catch (PDOException $e) {
        echo '<script>alert("Erreur de connexion à la base de données : '.$e->getMessage().'")</script>';
    }
}
?>


