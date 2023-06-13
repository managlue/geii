<?php
session_start();

include '../../modele/connexionBd.php';

if (!isset($_SESSION['id_entreprise'])) {
    header("location: /geii/view/accueil.php");
    exit();
}

if (isset($_GET['id']) && isset($_POST['titre']) && isset($_POST['lieu']) && isset($_POST['contrat']) && isset($_POST['date_limite']) && isset($_POST['description']) && isset($_POST['competences'])  && isset($_POST['remuneration']) && isset($_POST['postuler']) && isset($_POST['description_entr'])) {
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $titre = $_POST['titre'];
        $lieu = $_POST['lieu'];
        $contrat = $_POST['contrat'];
        $date_limite = $_POST['date_limite'];
        $description = $_POST['description'];
        $competences = $_POST['competences'];
        $remuneration = $_POST['remuneration'];
        $postuler = $_POST['postuler'];
        $description_entreprise = $_POST['description_entr'];


        try {


            $updates = [];
            $bindParams = [];


            if (!empty($titre)) {
                $updates[] = " titre_offre = :titre";
                $bindParams[] = [':titre', $titre];
            }
            if (!empty($lieu)) {
                $updates[] = "lieu = :lieu";
                $bindParams[] = [':lieu',  $lieu];
            }
            if (!empty($contrat)) {
                $updates[] = "contrat = :contrat";
                $bindParams[] = [':contrat', $contrat];
            }
            if (!empty($date_limite)) {
                $updates[] = "date_limite = :date_limite";
                $bindParams[] = [':date_limite', $date_limite];
            }
            if (!empty($description)) {
                $updates[] = "sujet_offre= :description";
                $bindParams[] = [':description', $description];
            }

            if (!empty($competences)) {
                $updates[] = "competences= :competences";
                $bindParams[] = [':competences', $competences];
            }

            if (!empty($remuneration)) {
                $updates[] = "remuneration = :remuneration";
                $bindParams[] = [':remuneration', $remuneration];
            }

            if (!empty($postuler)) {
                $updates[] = "postuler = :postuler";
                $bindParams[] = [':postuler', $postuler];
            }

            if (!empty($description_entr)) {
                $updates[] = "description_entr = :description_entr";
                $bindParams[] = [':description_entr', $description_entr];
            }



            $sql = "UPDATE offre_alternance SET";

            $updates_count = count($updates);
            foreach ($updates as $index => $update) {
                $sql .= " $update";
                if ($index < $updates_count - 1) {
                    $sql .= ",";
                }
            }

            $sql .= " WHERE  id_offre  = :id AND id_entreprise = :id_entreprise";

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

header("location: /geii/view/vues_entreprise/AfficherOffreBD.php");
