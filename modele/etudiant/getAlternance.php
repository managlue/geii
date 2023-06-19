<?php
    include '../../modele/connexionBd.php';
    $imagePath = '/geii/assets/img/';

    $sql = "SELECT competences, date_ajout, date_limite, description_entr, image, lieu, postuler, remuneration, sujet_offre, titre_offre, nom_entreprise
            FROM offre_alternance NATURAL JOIN entreprise";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($results)) echo "Aucun offre d'alternance n'a été ajouter";
    else {
?>

<div class="container text-center">
    <div class="row">

<?php
    $cpt = 0;
    foreach ($results as $offre) {
        $cpt++;
?>
        <div class="col-sm">
            <div class="card">

<?php echo '<img src="' . $imagePath . $offre['image'] . '" class="card-img-top img-thumbnail">'; ?>

                <div class="card-body">
                    <button type="button" class="btn btn-lg btn-danger" <?php echo 'data-bs-toggle="popover' . $cpt .'"'; ?> 

<?php echo 'data-bs-content="' . $offre['description_entr'] . '"'; ?> >
<?php echo '<h5 class="card-title">' . $offre['nom_entreprise'] . '</h5>'; ?>

                    </button>
                </div>
            </div>
        </div>

    <script>
        var popover = new bootstrap.Popover(document.querySelector(
            <?php echo "'[data-bs-toggle=" . '"popover' . $cpt . '"]' . "'"; ?>
        ));

        // dismissable
        const popover = new bootstrap.Popover('.popover-dismiss', {
            trigger: 'focus'
        })
    </script>

<?php
    }
?>

    </div>
</div>

<?php
    }
?>