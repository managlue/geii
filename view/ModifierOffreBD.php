<?php session_start(); ?>
<!DOCTYPE html>
<html>

<body>

    <?php
    if (!isset($_SESSION['id_entreprise'])) {
        header("location: /geii/view/AccueilEnt.php");
        exit();
    }

    if (
        isset($_POST['id']) && isset($_POST['titre']) && isset($_POST['lieu']) && isset($_POST['contrat']) && isset($_POST['date_limite']) && isset($_POST['description']) && isset($_POST['competences'])  && isset($_POST['remuneration']) && isset($_POST['postuler']) 
    ) {
        if (
            !empty($_POST['id']) && !empty($_POST['titre']) && !empty($_POST['lieu']) && !empty($_POST['contrat']) && !empty($_POST['date_limite']) && !empty($_POST['description']) && !empty($_POST['competences'])  && !empty($_POST['remuneration']) && !empty($_POST['postuler']) 
        ) {
            $id = $_POST['id'];
            $titre = $_POST['titre'];
            $lieu = $_POST['lieu'];
            $contrat = $_POST['contrat'];
            $date_limite = $_POST['date_limite'];
            $description = $_POST['description'];
            $competences = $_POST['competences'];
            $remuneration = $_POST['remuneration'];
            $postuler = $_POST['postuler'];

            try {
                $host = "localhost";
                $dbname = "id20742082_geii";
                $user = "root";
                $pass = "";

                $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, '');
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("UPDATE offre_alternance SET titre_offre = :titre, lieu = :lieu, contrat = :contrat, date_limite = :date_limite, sujet_offre = :description, competences = :competences, remuneration = :remuneration, postuler = :postuler WHERE id_offre = :id AND id_entreprise = :id_entreprise");

                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':titre', $titre);
                $stmt->bindParam(':lieu', $lieu);
                $stmt->bindParam(':contrat', $contrat);
                $stmt->bindParam(':date_limite', $date_limite);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':competences', $competences);
                $stmt->bindParam(':remuneration', $remuneration);
                $stmt->bindParam(':postuler', $postuler);
                $stmt->bindParam(':id_entreprise', $_SESSION['id_entreprise']);

                $stmt->execute();
            } catch (PDOException $e) {
                $message = "Échec de la mise à jour : " . $e->getMessage();
            }

            $conn = null;
        } else {
            $message = "Toutes les données doivent être renseignées";
        }
    } else {
        $message = "Toutes les données doivent être renseignées";
    }

    header("location:/geii/view/AfficherOffreBD.php");
    ?>
</body>

</html>
