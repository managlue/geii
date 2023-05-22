<?php
    $visible = true;
    
    $sql = "SELECT * 
            FROM $table 
            WHERE visible = :visible";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':visible', $visible, PDO::PARAM_BOOL);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($results)) {
?>

<!-- un carroussel avec des indicateurs et des commentaires -->
<div id="carousel" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-indicators">
        <?php
            // Boucle sur les résultats de la requête pour afficher les indicateurs de carrousel
            foreach ($results as $index => $image) {
                $activeClass = $index === 0 ? 'active' : '';
                echo '<button type="button"
                              data-bs-target="#carousel"
                              data-bs-slide-to="' . $index . '"
                              class="' . $activeClass . '"
                              aria-label="Slide ' . ($index + 1) . '">
                      </button>';
            }
        ?>
    </div>

    <div class="carousel-inner carousel-image">
        <?php
            // Boucle sur les résultats de la requête pour afficher les images du carroussel
            foreach ($results as $index => $image) {
                $activeClass = $index === 0 ? 'active' : '';
                echo '<div class="carousel-item ' . $activeClass . '">';
                echo '    <img src="' . $path . $image['url'] . '" 
                               class="d-block">';
                echo '    <div class="carousel-caption d-none d-md-block">';
                echo '        <h5>' . $image['nom'] . '</h5>';
                echo '        <p>' . $image['description'] . '</p>';
                echo '    </div>';
                echo '</div>';
            }
        ?>
    </div>

<?php
    if (count($results) > 1) {
?>

    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<?php
        }
    }
?>
