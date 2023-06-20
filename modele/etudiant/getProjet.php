<?php
    include '../../modele/connexionBd.php';
    $imagePath = '/geii/assets/img/';
    $pdfPath = '/geii/assets/pdf/';

    $sql = "SELECT titre_projet_tut, sujet_projet_tut, nom_entreprise, image_projet_tut, pdf_projet_tut
            FROM projet_tut NATURAL JOIN entreprise";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($results)) echo "Aucun projet tutoré n'a été ajouter";
    else {
?>

<style>
  .custom-card-image {
    width: auto;
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

<?php echo '<img src="' . $imagePath . $offre['image_projet_tut'] . '" class="custom-card-image mx-auto card-img-top img-thumbnail">'; ?>

                <div class="card-body">
                    <button type="button" class="btn btn-lg btn-danger"

<?php echo 'data-bs-toggle="popover' . $cpt .'"'; ?> 
<?php echo 'data-bs-content="' . '"'; ?> >
<?php echo '<h5 class="card-title">' . $offre['nom_entreprise'] . '</h5>'; ?>

                    </button><br><br>
                    <button type="button" class="btn btn-lg btn-primary"

<?php echo 'data-bs-toggle="popover' . $cpt .'a"'; ?>
<?php echo 'data-bs-content="' . $offre['sujet_projet_tut'] . '"'; ?> >
<?php echo '<h5 class="card-title">' . $offre['titre_projet_tut'] . '</h5>'; ?>

                    </button><br><br>
                    <p class="fs-5">

<?php echo '<a href="' . $pdfPath . $offre['pdf_projet_tut'] . '" download>télécharger le pdf</a>'; ?>

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
    mettre des boutons pour intégrer le groupe du projet ou le quitter
    empécher l'élargissement quand la ligne n'est pas complète
 -->
