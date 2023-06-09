<?php


if (isset($_GET['id'])) {
    $offre_id = $_GET['id'];

    $host = "localhost";
    $dbname = "id20742082_geii";
    $user = "root";
    $pass = "";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("DELETE FROM projet_tut WHERE id_projet_tut = :id");
        $stmt->bindParam(':id', $offre_id, PDO::PARAM_INT);
        $stmt->execute();
        echo '<script>';
        echo 'alert("Le Projet tutoré a été supprimée avec succès !");';
        echo '</script>';
    } catch (PDOException $e) {
        echo '<script>';
        echo 'alert("Échec de la suppression de l\'offre !");';
        echo '</script>';
       
    }

    header("location: /geii/view/vues_entreprise/AfficherProjet.php");
    exit();
}
?>