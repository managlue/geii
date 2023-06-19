<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=test", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['page_entreprise'])) {
        $pageActuelle_entreprise = $_GET['page_entreprise'];
    } else {
      $pageActuelle_entreprise = 1;
    }

    $entrepriseParPage = 3;
    $indiceDepart = ($pageActuelle_entreprise - 1) *  $entrepriseParPage;

    $stmt = $conn->prepare("SELECT id_entreprise, nom_entreprise, mail_entreprise, tel_entreprise FROM entreprise
                            LIMIT :start, :limit");
    $stmt->bindValue(':start', $indiceDepart, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $entrepriseParPage, PDO::PARAM_INT);
    $stmt->execute();
    $entreprises = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Compter le nombre total d'entreprises
    $stmtCount = $conn->query("SELECT COUNT(*) FROM entreprise");
    $totalEntreprises = $stmtCount->fetchColumn();

    // Calcul du nombre total de pages
    $totalPages_entreprise = ceil($totalEntreprises /  $entrepriseParPage);
    
} catch (PDOException $e) {
    $message = "Echec de la récupération des éléments : " . $e->getMessage();
}
?>