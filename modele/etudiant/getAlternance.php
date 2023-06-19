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

<style>
  .custom-card-image {
    width: 250px;
    height: 150px;
    object-fit: cover;
  }
</style>

<div class="container text-center">
    <div class="row">

<?php
    $cpt = 0;
    foreach ($results as $offre) {
        $cpt++;
?>
        <div class="col-sm">
            <div class="card">

<?php echo '<img src="' . $imagePath . $offre['image'] . '" class="custom-card-image mx-auto card-img-top img-thumbnail">'; ?>

                <div class="card-body">
                    <button type="button" class="btn btn-lg btn-danger"

<?php echo 'data-bs-toggle="popover' . $cpt .'"'; ?> 
<?php echo 'data-bs-content="' . $offre['description_entr'] . '"'; ?> >
<?php echo '<h5 class="card-title">' . $offre['nom_entreprise'] . '</h5>'; ?>

                    </button><br><br>
                    <button type="button" class="btn btn-lg btn-primary"

<?php echo 'data-bs-toggle="popover' . $cpt .'a"'; ?>
<?php echo 'data-bs-content="' . $offre['sujet_offre'] . '"'; ?> >
<?php echo '<h5 class="card-title">' . $offre['titre_offre'] . '</h5>'; ?>

                    </button><br><br>
                    <p class="fs-5">

<?php echo $offre['lieu'] . '<br>'; ?>
<?php echo 'Rémunération : ' . $offre['remuneration'] . '<br>'; ?>
<?php echo 'Date limite : ' . $offre['date_limite'] . '<br>'; ?>
<?php echo 'Postuler : ' . $offre['postuler']; ?> 

                    </p>
                </div>
            </div>
        </div>

    <script>
        var popover = new bootstrap.Popover(document.querySelector(
            <?php echo "'[data-bs-toggle=" . '"popover' . $cpt . '"]' . "'"; ?>
        ));
        var popovera = new bootstrap.Popover(document.querySelector(
            <?php echo "'[data-bs-toggle=" . '"popover' . $cpt . 'a"]' . "'"; ?>
        ));
    </script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->


<?php
    }
?>

    </div>
</div>

<?php
    }
?>

<!-- 
    vois d'améliorations :
    mettre des popovers "Dismiss on next click"
 -->
