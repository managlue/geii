<?php

$host = "localhost";
$dbname = "test";
$user = "root";
$pass = "";

if (isset($_GET['enseignant_id'])) {

    $enseignant_id = $_GET['enseignant_id'];
   
    try {

        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("DELETE FROM enseignant WHERE id_enseignant = :enseignant_id");
        $stmt->bindParam(':enseignant_id', $enseignant_id, PDO::PARAM_INT);

        $stmt->execute();
        echo "<p>Suppression(s) effectuée(s) : " . $stmt->rowCount() . "</p>\n";


    } catch (PDOException $e) {
        
        echo "<p>Echec de la suppression : " . $e->getMessage() ."</p>\n";
       
    }

    header("location: /Accueil/vues_admin/Admin.php");
    exit();
}
?>