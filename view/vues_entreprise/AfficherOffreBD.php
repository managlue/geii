<?php session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Offre Alternance</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
  <link rel="stylesheet" href="../../css/Entreprise_CSS/AfficherOffre.css">

</head>


<body>

  <?php

  include '../../modele/connexionBd.php';

  if (isset($_SESSION['id_entreprise'])) {
    try {

      $stmt = $pdo->prepare("SELECT * FROM offre_alternance JOIN entreprise ON offre_alternance.id_entreprise = entreprise.id_entreprise WHERE offre_alternance.id_entreprise = :id_entreprise");
      $stmt->bindParam(':id_entreprise', $_SESSION['id_entreprise']);
      $stmt->execute();

      // Afficher les éléments ajoutés par l'entreprise connectée
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="container bcontent"> ';
        echo '<div class="accordion" id="accordionExample">';
        echo '<div class="card  border-bottom">';
        echo '<div class="card-header" id="headingOne">';
        $imageURL = '../../assets/img/' . $row['image'];

        echo "<td><img src='" . $imageURL . "' height='100' width='100'></td>\n";
        echo ' <h4 class="card-subtitle text-muted d-inline-block">' . $row['nom_entreprise'] . '</h4>';
        echo ' <h5 class="mb-0">';
        echo '<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse' . $row['id_offre'] . '" aria-expanded="false" aria-controls="collapse' . $row['id_offre'] . '">' . $row['titre_offre'] . '</button>';
        echo '</h5>';
        echo '<div>';

        echo '<span class="badge badge-primary bg-white text-dark border border-dark" id="contrat">' . $row['contrat'] . '</span>';
        echo '<span class="badge badge-primary bg-white text-dark border border-dark" id="lieu">' . $row['lieu'] . '</span>';

        // Heure de publication de l'offre d'emploi
        $dateAjout = $row['date_ajout'];

        // Heure actuelle
        date_default_timezone_set('Europe/Paris');
        $heureActuelle = date("Y-m-d H:i:s");


        // Calcul de la différence en secondes entre l'heure actuelle et l'heure de publication
        $diffEnSecondes = strtotime($heureActuelle) - strtotime($dateAjout);

        // Calcul de la différence en minutes
        $diffEnMinutes = floor($diffEnSecondes / 60);

        // Calcul de la différence en heures
        $diffEnHeures = floor($diffEnMinutes / 60);

        // Calcul de la différence en jours
        $diffEnJours = floor($diffEnHeures / 24);

        // Affichage du temps écoulé
        if ($diffEnJours > 0) {
          echo '<span class="badge badge-primary bg-white text-dark border border-dark" id="lieu">' . "Publiée il y a " . $diffEnJours . " jour(s)." . '</span>';
        } elseif ($diffEnHeures > 0) {
          echo '<span class="badge badge-primary bg-white text-dark border border-dark" id="lieu">' . "Publiée il y a " . $diffEnHeures . " heure(s)." . '</span>';
        } elseif ($diffEnMinutes > 0) {
          echo '<span class="badge badge-primary bg-white text-dark border border-dark" id="lieu">' . "Publiée il y a " . $diffEnMinutes  . " minute(s)." . '</span>';
        } else {
          echo '<span class="badge badge-primary bg-white text-dark border border-dark" id="lieu">' . "Publiée il y a " . $diffEnSecondes  . " seconde(s)." . '</span>';
        }

        echo '</div>';
        echo '<div>';
        $description = $row['sujet_offre'];
        $partie_description = substr($description, 0, 100);
        echo '<p class="card-text" id="description">' . $partie_description . '</p>';
        echo '</div>';
        echo '<div class="d-flex justify-content-end align-items-center">';
        echo '<div>';
        echo '<a href="ModifierOffre.php?id=' . $row['id_offre'] . '"><button class="btn btn-primary">Modifier l\'offre</button></a>';
        echo '<a href="SupprimerOffre.php?id=' . $row['id_offre'] . '"><button class="btn btn-danger ml-2">Supprimer l\'offre</button></a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        echo '<div id="collapse' . $row['id_offre'] . '" class="collapse" aria-labelledby="heading' . $row['id_offre'] . '" data-parent="#accordionExample">';
        echo '<div class="card-body">';
        echo '<h6 class="card-subtitle text-muted">Détails du poste</h6>';
        echo '<div class="offre-details">';

        echo '<div class="info">';
        echo '<hr />';
        //  echo '<div class="label">Qui sommes-nous :</div>';
        //  echo '<div class="value">' . $row['description_entr'] . '</div>';
        echo $row['description_entr'];
        echo '</div>';

        echo '<br />';

        echo '<div class="info">';
        echo '<div class="label">Type de poste :  ' .  $row['contrat'] . ' </div>';
        echo '</div>';

        echo '<br />';

        echo '<div class="info">';
        echo '<div class="label">Profil recherché :</div>';
        echo  ' Diplômé(e) d\'une école universitaire en Génie Électrique et Informatique Industrielle (GEII)';
        echo '</div>';

        echo '<br />';

        echo '<div class="info">';
        echo '<div class="label">Vos missions :</div>';
        echo  $row['sujet_offre'];
        echo '</div>';

        echo '<br />';
        echo '<div class="info">';
        echo '<div class="label">Compétences :</div>';
        echo $row['competences'];
        // echo '</div>';
        echo '</div>';

        echo '<br />';
        echo '<div class="info">';
        echo '<div class="label">Comment postuler à cette offre :</div>';
        // echo '<div class="value">' . $row['postuler'] . '</div>';
        echo $row['postuler'];
        // echo '</div>';
        echo '</div>';

        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
    } catch (PDOException $e) {
      $message = "Echec de la récupération des éléments : " . $e->getMessage();
    }

  
  }
  ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
  <script src="../../script/AfficherOffre.js"></script>
</body>

</html>