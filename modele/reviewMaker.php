<?php
    $stmt = $pdo->query("SELECT * FROM $table LIMIT 15");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($results)) {
        var_dump($results);
        foreach ($results as $avis) {
            echo '<div class="avis">';
            echo '<p>' . $avis['message'] . '</p>';
            echo '<p><b>- ' . $avis['nom'] . ', venu avec ' . $avis['pokepartenaire'] . '.</b></p>';
            echo '</div>';
        }
    }
?>
