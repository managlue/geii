<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=test", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
    if (isset($_GET['page_etudiant'])) {
      $pageActuelle_Etudiant = $_GET['page_etudiant'];
  } else {
    $pageActuelle_Etudiant = 1;
  }
  
    $etudiantsParPage = 3;
    $indiceDepart = ($pageActuelle_Etudiant - 1) * $etudiantsParPage;
    
    // Requête pour récupérer les étudiants paginés
    $stmt = $conn->prepare("SELECT  etudiant.id_etudiant, nom_etudiant, prenom_etudiant, login_etudiant, pswd_etudiant, nom_classe 
                            FROM etudiant
                            JOIN classe ON etudiant.id_classe = classe.id_classe
                            LIMIT :start, :limit");
    $stmt->bindValue(':start', $indiceDepart, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $etudiantsParPage, PDO::PARAM_INT);
    $stmt->execute();
    $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Compter le nombre total d'étudiants
    $stmtCount = $conn->query("SELECT COUNT(*) FROM etudiant");
    $totalEtudiants = $stmtCount->fetchColumn();
    
    // Calcul du nombre total de pages
    $totalPages_Etudiant = ceil($totalEtudiants / $etudiantsParPage);
} catch (PDOException $e) {
    $message = "Echec de la récupération des éléments : " . $e->getMessage();
}
?>