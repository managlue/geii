<!DOCTYPE html>
<html>

<body>

    <?php

    session_start();

    include '../../modele/connexionBd.php';

    if (!isset($_SESSION['id_entreprise'])) {
        header("location: /geii/view/vues_accueil/accueil.php");
        exit();
    }

    if (
        isset($_POST['titre']) && isset($_POST['lieu']) && isset($_POST['contrat']) && isset($_POST['date_limite']) && isset($_POST['description']) && isset($_POST['competences']) && isset($_POST['remuneration']) && isset($_POST['postuler']) && isset($_FILES["image"]["name"]) && isset($_POST['description_entr'])
    ) {
        $titre = $_POST['titre'];
        $lieu = $_POST['lieu'];
        $contrat = $_POST['contrat'];
        $date_limite = $_POST['date_limite'];
        $description = $_POST['description'];
        $competences = $_POST['competences'];
        $remuneration = $_POST['remuneration'];
        $postuler = $_POST['postuler'];
        $description_entr = $_POST['description_entr'];

        $directory = "../../assets/img/";
        $file_Name = basename($_FILES["image"]["name"]);
        $file_Path = $directory . $file_Name;
        $file_Type = pathinfo($file_Path, PATHINFO_EXTENSION);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $file_Path)) {
            try {
                // Vérifier si une offre avec le même titre existe déjà
                $stmt = $pdo->prepare("SELECT * FROM offre_alternance WHERE titre_offre = :titre AND id_entreprise = :id_entreprise");
                $stmt->bindParam(':titre', $titre);
                $stmt->bindParam(':id_entreprise', $_SESSION['id_entreprise']);
                $stmt->execute();
                $existingOffer = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($existingOffer) {
                    // Une offre avec le même titre existe déjà
                    $message = "Une offre avec le même titre existe déjà.";
                } else {
                    // Insérer une nouvelle offre
                    $stmt = $pdo->prepare("INSERT INTO offre_alternance (titre_offre, lieu, contrat, date_limite, sujet_offre, competences, remuneration, postuler, image, description_entr, id_entreprise) VALUES (:titre, :lieu, :contrat, :date_limite, :description, :competences, :remuneration, :postuler, :image, :description_entr, :id_entreprise)");

                    $stmt->bindParam(':titre', $titre);
                    $stmt->bindParam(':lieu', $lieu);
                    $stmt->bindParam(':contrat', $contrat);
                    $stmt->bindParam(':date_limite', $date_limite);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':competences', $competences);
                    $stmt->bindParam(':remuneration', $remuneration);
                    $stmt->bindParam(':postuler', $postuler);
                    $stmt->bindParam(':image', $file_Name);
                    $stmt->bindParam(':description_entr', $description_entr);
                    $stmt->bindParam(':id_entreprise', $_SESSION['id_entreprise']);

                    $stmt->execute();
                }
            } catch (PDOException $e) {
                $message = "Echec de l'insertion : " . $e->getMessage();
            }

        } else {
            $message = "Erreur lors du téléchargement du visuel.";
        }
    } else {
        $message = "Toutes les données doivent être renseignées";
    }
    header("location: /geii/view/vues_entreprise/AccueilEntreprise.php");
    ?>

</body>

</html>