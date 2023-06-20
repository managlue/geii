<?php session_start(); ?> 
<!DOCTYPE html>
<html>
<head>
  <title>Espace entreprise</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../bootstrap-5.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../css/Entreprise_CSS/StyleAEntreprise.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
<body>

<?php if (!isset($_SESSION['id_entreprise'])) {
        header("location: /geii/view/vues_entreprise/co.php");
        exit();
    }?>

<?php include "../header.php"?>
<div class="header-nightsky"></div>
    <div class="hero">
        <h1>Espace Entreprise</h1>
    </div>


    <section class="wrapper">
      <div class="container-fostrap">
        <div>
          <h1 class="heading">Projets Récemment ajoutés</h1>
        </div>

    <?php
    include '../../modele/connexionBd.php';

    if (isset($_SESSION['id_entreprise'])) {
      try {

        $stmt = $pdo->prepare("SELECT * FROM projet_tut JOIN entreprise ON projet_tut.id_entreprise = entreprise.id_entreprise WHERE projet_tut.id_entreprise = :id_entreprise ORDER BY dateajout_projet_tut DESC LIMIT 3");
        $stmt->bindParam(':id_entreprise', $_SESSION['id_entreprise']);
        $stmt->execute();

        // Récupérer le nombre total de projets récemment ajoutés par l'entreprise
        $totalProjets = $stmt->rowCount();

        // Affichage des projets récemment ajoutés
        if ($totalProjets > 0) {

          echo '<div class="content">';
          echo '<div class="container">';
          echo '<div class="row">';

          // Parcourir les projets récemment ajoutés
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-xs-12 col-sm-4">';
            echo '<div class="card">';
            echo '<a class="img-card">';
            $imageURL = '../../assets/img/' . $row['image_projet_tut'];
            echo '<img src="' . $imageURL . '" />';
            echo '</a>';
            echo '<div class="card-content">';
            echo '<h4 class="card-title">';
            echo '<a >' . $row['titre_projet_tut'] . '</a>';
            echo '</h4>';
            $description = $row['sujet_projet_tut'];
            $partie_description = substr($description, 0, 100);
            echo '<p class="">' . $partie_description . '</p>';
            echo '</div>';
            echo '<div class="card-read-more">';
            echo '<a href="AfficherProjet.php" class="btn btn-link btn-block">En savoir plus</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
          }

          echo '</div>';
          echo '</div>';
          echo '</div>';
        } else {
          echo '<p>Aucun projet récemment ajouté.</p>';
        }
      } catch (PDOException $e) {
        echo "Échec de la récupération des projets : " . $e->getMessage();
      }

    } else {
      echo '<p>Connectez-vous pour voir les projets récemment ajoutés.</p>';
    }
    ?>

    <section class="wrapper">
      <div class="container-fostrap">
        <div>
          <h1 class="heading">Offres Récemment ajoutées</h1>
        </div>

        <?php
        if (isset($_SESSION['id_entreprise'])) {
          try {

            $stmt = $pdo->prepare("SELECT * FROM offre_alternance JOIN entreprise ON offre_alternance.id_entreprise = entreprise.id_entreprise WHERE offre_alternance.id_entreprise = :id_entreprise ORDER BY date_ajout DESC LIMIT 3");
            $stmt->bindParam(':id_entreprise', $_SESSION['id_entreprise']);
            $stmt->execute();

            // Récupérer le nombre total d'offres récemment ajoutées par l'entreprise
            $totalOffres = $stmt->rowCount();

            // Affichage des offres récemment ajoutées
            if ($totalOffres > 0) {
              echo '<div class="content">';
              echo '<div class="container">';
              echo '<div class="row">';

              // Parcourir les offres récemment ajoutées
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="col-xs-12 col-sm-4">';
                echo '<div class="card">';
                echo '<a class="img-card">';
                $imageURL = '../../assets/img/' . $row['image'];
                echo '<img src="' . $imageURL . '" />';
                echo '</a>';
                echo '<div class="card-content">';
                echo '<h4 class="card-title">';
                echo '<a >' . $row['titre_offre'] . '</a>';
                echo '</h4>';
                $description = $row['sujet_offre'];
                $partie_description = substr($description, 0, 100);
                echo '<p class="">' . $partie_description . '</p>';
                echo '</div>';
                echo '<div class="card-read-more">';
                echo '<a href="AfficherOffreBD.php" class="btn btn-link btn-block">En savoir plus</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
              }

              echo '</div>';
              echo '</div>';
              echo '</div>';
            } else {
              echo '<p>Aucune offre récemment ajoutée.</p>';
            }
          } catch (PDOException $e) {
            echo "Échec de la récupération des offres : " . $e->getMessage();
          }

        } else {
          echo '<p>Connectez-vous pour voir les offres récemment ajoutées.</p>';
        }
        ?>
      </div>
    </section>
    <?php include '../footer.php'  ?>

    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script src="../../bootstrap-5.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>