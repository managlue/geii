<?php
session_start();

if (!isset($_SESSION['id_entreprise'])) {
    header("location: /geii/view/accueil.php");
    exit();
}

if (
     isset($_POST['titre_projet_tut']) && isset($_POST['sujet_projet_tut'])&& isset($_POST['datedebut_projet_tut']) && isset($_POST['datefin_projet_tut']) && isset($_FILES["image_projet_tut"]["name"]) && isset($_FILES["pdf_projet_tut"]["name"])
) {
   
    $titre_projet_tut = $_POST['titre_projet_tut'];
    $sujet_projet_tut = $_POST['sujet_projet_tut'];
    $debut_projet_tut = $_POST['datedebut_projet_tut'];
    $fin_projet_tut = $_POST['datefin_projet_tut'];


    $directory = "../../assets/img/";
    $file_Name = basename($_FILES["image_projet_tut"]["name"]);
    $file_Path = $directory . $file_Name;
    $file_Type = pathinfo($file_Path, PATHINFO_EXTENSION);

    $pdf_directory = "../../assets/pdf/";
    $pdf_file_Name = basename($_FILES["pdf_projet_tut"]["name"]);
    $pdf_file_Path = $pdf_directory . $pdf_file_Name;
    $pdf_file_Type = pathinfo($pdf_file_Path, PATHINFO_EXTENSION);

    if (move_uploaded_file($_FILES["image_projet_tut"]["tmp_name"], $file_Path) && move_uploaded_file($_FILES["pdf_projet_tut"]["tmp_name"], $pdf_file_Path)) {
        try {
            $host = "localhost";
            $dbname = "id20742082_geii";
            $user = "root";
            $pass = "";

            $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

             // Vérifier si le projet existe déjà
             $existingStmt = $conn->prepare("SELECT * FROM projet_tut WHERE titre_projet_tut = :titre_projet_tut AND id_entreprise = :id_entreprise");
             $existingStmt->bindParam(':titre_projet_tut',  $titre_projet_tut);
             $existingStmt->bindParam(':id_entreprise', $_SESSION['id_entreprise']);
             $existingStmt->execute();
 
             if ($existingStmt->rowCount() > 0) {
                echo "<script>alert(\"Le projet a déjà été ajouté\");</script>";             
            } else {

            $stmt = $conn->prepare("INSERT INTO projet_tut (titre_projet_tut, sujet_projet_tut, datedebut_projet_tut,datefin_projet_tut, image_projet_tut, pdf_projet_tut, id_entreprise) VALUES (:titre_projet_tut, :sujet_projet_tut, :datedebut_projet_tut,:datefin_projet_tut, :image_projet_tut, :pdf_projet_tut, :id_entreprise)");

            $stmt->bindParam(':titre_projet_tut', $titre_projet_tut);
            $stmt->bindParam(':sujet_projet_tut', $sujet_projet_tut);
            $stmt->bindParam(':datedebut_projet_tut', $debut_projet_tut);
            $stmt->bindParam(':datefin_projet_tut', $fin_projet_tut);
            $stmt->bindParam(':image_projet_tut', $file_Name);
            $stmt->bindParam(':pdf_projet_tut', $pdf_file_Name);
            $stmt->bindParam(':id_entreprise', $_SESSION['id_entreprise']);

            $stmt->execute();
             }
        } catch (PDOException $e) {
            $message = "Echec de l'insertion : " . $e->getMessage();
        }

        $conn = null;
    } else {
        $message = "Erreur lors du téléchargement des fichiers.";
    }
} else {
    $message = "Toutes les données doivent être renseignées";
}
header("location: /geii/view/vues_entreprise/AccueilEntreprise.php");
