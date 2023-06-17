<?php


if (isset($_GET['entre_id']) && isset($_POST['NomEntreprise']) && isset($_POST['email_inscription']) && isset($_POST['phone']) && isset($_POST['pwd_inscription']) && isset($_POST['confirm_pwd'])) {
    if (!empty($_GET['entre_id'])) {
        $entreprise_id = $_GET['entre_id'];
        $NomEntreprise = $_POST['NomEntreprise'];
        $email_inscription = $_POST['email_inscription'];
        $phone = $_POST['phone'];
        $pwd_inscription = $_POST['pwd_inscription'];
        $confirm_pwd = $_POST['confirm_pwd'];

       
        
            try {
                $host = "localhost";
$dbname = "test";
$user = "root";
$pass = "";
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $updates = [];
                $bindParams = [];

                if (!empty($NomEntreprise)) {
                    $updates[] = "nom_entreprise = :NomEntreprise";
                    $bindParams[] = [':NomEntreprise', $NomEntreprise];
                }
                if (!empty($email_inscription)) {
                    $updates[] = "mail_entreprise = :email_inscription";
                    $bindParams[] = [':email_inscription', $email_inscription];
                }
                if (!empty($phone)) {
                    $updates[] = "tel_entreprise = :phone";
                    $bindParams[] = [':phone', $phone];
                }
                if (!empty($pwd_inscription)) {

                    $updates[] = "pswd_entreprise = :pwd_inscription";
                    $bindParams[] = [':pwd_inscription', $pwd_inscription];
                    }
                

                $sql = "UPDATE entreprise SET";

                $updates_count = count($updates);
                foreach ($updates as $index => $update) {
                    $sql .= " $update";
                    if ($index < $updates_count - 1) {
                        $sql .= ",";
                    }
                }

                $sql .= " WHERE id_entreprise = :entre_id ";

                $bindParams[] = [':entre_id', $entreprise_id];

                $stmt = $pdo->prepare($sql);

                // foreach pour les bindparam
                foreach ($bindParams as $bindParam) {
                    $stmt->bindParam($bindParam[0], $bindParam[1]);
                }

                // execute
                $stmt->execute();
                $message = "Les informations de l'entreprise ont été mises à jour avec succès.";
            } catch (PDOException $e) {
                $message = "Échec de la mise à jour : " . $e->getMessage();
            }
        }
    } 
 else {
    $message = "Toutes les données doivent être renseignées.";
}

header("location: /Accueil/vues_admin/Admin.php");
?>