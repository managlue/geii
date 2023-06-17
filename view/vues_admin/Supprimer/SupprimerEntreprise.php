<?php

$host = "localhost";
$dbname = "test";
$user = "root";
$pass = "";

if (isset($_GET['entreprise_id'])) {

    $entreprise_id = $_GET['entreprise_id'];
   
    try {

        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("DELETE FROM entreprise WHERE id_entreprise = :entreprise_id");
        $stmt->bindParam(':entreprise_id', $entreprise_id, PDO::PARAM_INT);

        $stmt->execute();
        echo "<p>Suppression(s) effectuée(s) : " . $stmt->rowCount() . "</p>\n";


    } catch (PDOException $e) {
        
        echo "<p>Echec de la suppression : " . $e->getMessage() ."</p>\n";
       
    }

    header("location: /Accueil/vues_admin/Admin.php");
    exit();
}
?>