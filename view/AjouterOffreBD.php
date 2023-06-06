<?php
session_start();
?>

<!DOCTYPE html>
<html>
<body>

<?php
if (!isset($_SESSION['id_entreprise'])) {
    header("location: /geii/view/index.php");
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

    $directory = "../assets/img/";
    $file_Name = basename($_FILES["image"]["name"]);
    $file_Path = $directory . $file_Name;
    $file_Type = pathinfo($file_Path, PATHINFO_EXTENSION);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $file_Path)) {
        try {

            $host = "localhost";
            $dbname = "id20742082_geii";
            $user = "root";
            $pass = "";
            
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            

            $stmt = $conn->prepare("INSERT INTO offre_alternance (titre_offre, lieu, contrat, date_limite, sujet_offre, competences, remuneration, postuler, image, description_entr, id_entreprise) VALUES (:titre, :lieu, :contrat, :date_limite, :description, :competences, :remuneration, :postuler, :image, :description_entr, :id_entreprise)");

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
        } catch (PDOException $e) {
            $message = "Echec de l'insertion : " . $e->getMessage();
        }

        $conn = null;
    } else {
        $message = "Erreur lors du téléchargement du visuel.";
    }
} else {
    $message = "Toutes les données doivent être renseignées";
}
header("location: /geii/view/AccueilEntreprise.php");
?>

</body>
</html>
