<?php
    // partie récupération des titres des colonnes
    $sql = "SELECT column_name
            FROM information_schema.columns
            WHERE table_name = :table
            ORDER BY ordinal_position";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':table', $table);
    $stmt->execute(); 
    $colonnes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    unset($colonnes[0]);

    if (!empty($colonnes)) {
        var_dump($colonnes);
?>

<table class="table table-striped">
    <thead>
        <tr>

<?php
    // affichage des titres des colonnes
    foreach ($colonnes as $colonne)
        echo '<th scope="col">' . $colonne['column_name'] . '</th>';
?>

        </tr>
    </thead>
    <tbody>

<?php
    // partie récupération du contenu du tableau
    $stmt = $pdo->query("SELECT * FROM $table");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($results)) {
        var_dump($results);
        foreach ($results as $ligne) {
            echo "<tr>";
            foreach ($ligne as $ligneKey => $ligneElement) {
                if ($ligneKey != 'id') echo "<td>$ligneElement</td>";
            }
            echo "</tr>";
        }
?>

    </tbody>
</table>

<?php
        }
    }
?>
