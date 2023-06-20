<?php

session_start();

include '../../modele/connexionBd.php';

if (!isset($_SESSION['id_entreprise'])) {
    header("location: /geii/accueil.php");
    exit();
}

if (isset($_POST['id']) && isset($_POST['titre_projet_tut'])&& isset($_POST['sujet_projet_tut'])&& isset($_POST['datedebut_projet_tut'])&& isset($_POST['datefin_projet_tut'])) {
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $titre_projet_tut = $_POST['titre_projet_tut'];
        $sujet_projet_tut = $_POST['sujet_projet_tut'];
        $debut_projet_tut = $_POST['datedebut_projet_tut'];
        $fin_projet_tut = $_POST['datefin_projet_tut'];

        $pdf_directory = "../../assets/pdf/";
        $pdf_file_Name = basename($_FILES["pdf_projet_tut"]["name"]);
        $pdf_file_Path = $pdf_directory . $pdf_file_Name;
        $pdf_file_Type = pathinfo($pdf_file_Path, PATHINFO_EXTENSION);

        try {
      
            $updates = [];
            $bindParams = [];

            if (!empty($_FILES["pdf_projet_tut"]["name"])) {
                $updates[] = "pdf_projet_tut = :pdf_projet_tut";
                $bindParams[] = [':pdf_projet_tut', $pdf_file_Name];
            }
            if (!empty($titre_projet_tut)) {
                $updates[] = "titre_projet_tut = :titre_projet_tut";
                $bindParams[] = [':titre_projet_tut', $titre_projet_tut];
            }
            if (!empty($sujet_projet_tut)) {
                $updates[] = "sujet_projet_tut = :sujet_projet_tut";
                $bindParams[] = [':sujet_projet_tut', $sujet_projet_tut];
            }
            if (!empty($debut_projet_tut)) {
                $updates[] = "datedebut_projet_tut = :datedebut_projet_tut";
                $bindParams[] = [':datedebut_projet_tut', $debut_projet_tut];
            }
            if (!empty($fin_projet_tut)) {
                $updates[] = "datefin_projet_tut = :datefin_projet_tut";
                $bindParams[] = [':datefin_projet_tut', $fin_projet_tut];
            }

            $sql = "UPDATE projet_tut SET";

            $updates_count = count($updates);
            foreach ($updates as $index => $update) {
                $sql .= " $update";
                if ($index < $updates_count - 1) {
                    $sql .= ",";
                }
            }

            $sql .= " WHERE  id_projet_tut = :id AND id_entreprise = :id_entreprise";
            
            $bindParams[] = [':id', $id];
            $bindParams[] = [':id_entreprise', $_SESSION['id_entreprise']];

            $stmt = $pdo->prepare($sql);

              // foreach pour les bindparam
            foreach ($bindParams as $bindParam) {
                $stmt->bindParam($bindParam[0], $bindParam[1]);
            }

              // execute
            $stmt->execute();

        } catch (PDOException $e) {
            $message = "Échec de la mise à jour : " . $e->getMessage();
        }

    } else {
        $message = "Toutes les données doivent être renseignées.";
    }
} else {
    $message = "Toutes les données doivent être renseignées.";
}

header("location: /geii/view/vues_entreprise/AfficherProjet.php");
