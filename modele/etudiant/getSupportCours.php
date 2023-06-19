<?php
    $pdfPath = "/geii/assets/supports_de_cours_pdf/";

    $sql = "SELECT nom_fichier, nom_enseignant
            FROM Support_de_cours NATURAL JOIN Enseignant
            WHERE id_classe = :id";
    if (isset($limit)) $sql .= " LIMIT :limit";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_SESSION['idClass']);
    if (isset($limit)) $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($results)) echo "Aucun support de cours n'a été ajouter";
    else {
?>

<table class="table table-light table-striped">
    <thead>
        <tr>
            <th scope="col">Fichier partagés</th>
            <th scope="col">Professeur</th>
        </tr>
    </thead>
    <tbody>

<?php
    foreach ($results as $support) {
        echo '<tr>';
        echo '<td><a href="' . $pdfPath . $support['nom_fichier'] . '" download>' . $support['nom_fichier'] . '</a></td>';
        echo '<td>' . $support['nom_enseignant'] . '</td>';
        echo '</tr>';
    }
?>

    </tbody>
</table>

<?php
    }
?>

<!-- 
    pour améliorer :
    faire une recherche/un trie par date/prof
-->
