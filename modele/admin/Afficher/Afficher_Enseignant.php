<?php

include '../../modele/connexionBd.php';

try {
   
    if (isset($_GET['page_enseignant'])) $pageActuelle_Enseignant = $_GET['page_enseignant'];
    else $pageActuelle_Enseignant = 1;

    $enseignantsParPage = 3;
    $indiceDepart = ($pageActuelle_Enseignant - 1) * $enseignantsParPage;

    // Requête pour récupérer les enseignants paginés
    $stmt = $pdo->prepare("SELECT  enseignant.id_enseignant, nom_enseignant, prenom_enseignant, login_enseignant, pswd_enseignant, nom_classe 
                            FROM enseignant 
                            JOIN enseignant_classe ON enseignant.id_enseignant = enseignant_classe.id_enseignant
                            JOIN classe ON enseignant_classe.id_classe = classe.id_classe
                            LIMIT :start, :limit");
    $stmt->bindValue(':start', $indiceDepart, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $enseignantsParPage, PDO::PARAM_INT);
    $stmt->execute();
 
    $enseignants = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Compter le nombre total d'enseignants
    $stmtCount = $pdo->query("SELECT COUNT(*) FROM enseignant");
    $totalEnseignants = $stmtCount->fetchColumn();

   

    // Calcul du nombre total de pages
    $totalPages = ceil($totalEnseignants / $enseignantsParPage);
   } catch (PDOException $e) {
    $message = "Echec de la récupération des éléments : " . $e->getMessage();
}

?>