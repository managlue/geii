<?php
    $sql = "SELECT nom_matiere, note, coefficient, commentaire
            FROM Note NATURAL JOIN Etudiant NATURAL JOIN Matiere
            WHERE id_etudiant = :id";
    if (isset($limit)) $sql .= "\n            LIMIT :limit";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_SESSION['idConnected']);
    if (isset($limit)) $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($results)) echo "Aucune notes n'a encore été ajoutés par vos professeurs";
    else {
?>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Matiere</th>
            <th scope="col">Note</th>
            <th scope="col">Coefficient</th>
            <th scope="col">Commentaire</th>
        </tr>
    </thead>
    <tbody>

<?php
    foreach ($results as $ligne) {
        echo "<tr>";
        foreach ($ligne as $ligneKey => $ligneElement) echo "<td>$ligneElement</td>";
        echo "</tr>";
    }
?>

    </tbody>
</table>

<?php
    }
?>

