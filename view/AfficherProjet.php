<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Projets tutorés</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../css/AfficherProjet.css">
</head>

<body>
  <?php
  if (isset($_SESSION['id_entreprise'])) {
    try {
      $host = "localhost";
      $dbname = "id20742082_geii";
      $user = "root";
      $pass = "";

      $conn = new PDO("mysql:host=$host;dbname=$dbname", 'root', '');
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $conn->prepare("SELECT * FROM projet_tut JOIN entreprise ON projet_tut.id_entreprise = entreprise.id_entreprise WHERE projet_tut.id_entreprise = :id_entreprise");
      $stmt->bindParam(':id_entreprise', $_SESSION['id_entreprise']);
      $stmt->execute();

      // Afficher les éléments ajoutés par l'entreprise connectée
      $numProjet = 0; // Variable pour compter le nombre de projets
      echo '<div id="carouselExampleControls" class="carousel" data-bs-ride="carousel">';
      echo '<div class="carousel-inner">';
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $numProjet++; // Incrémenter le compteur de projets
        $isActive = ($numProjet == 1) ? 'active' : ''; // Vérifier si c'est le premier projet pour la classe "active"
        echo '<div class="carousel-item ' . $isActive . '">';
        echo '<div class="card">';
        $imageURL = '../assets/img/' . $row['image_projet_tut'];
        echo '<div class="img-wrapper"><img src="' . $imageURL . '" class="d-block w-100" alt="..."></div>';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">'; 
        echo   $row['titre_projet_tut'];
        echo '<a href="ModifierProjet.php?id=' . $row['id_projet_tut'] . '"><i class="fas fa-edit" style="color: black; padding-left: 25px;"></i></a>';
        echo '<a href="SupprimerProjet.php?id=' . $row['id_projet_tut'] . '"><i class="fas fa-trash" style="color: black;padding-left: 5px;"></i></a>';
        echo '</h5>';
        echo '<div class="ml-2">';
       
        echo '</div>';
        
        $description = $row['sujet_projet_tut'];
        $partie_description = substr($description, 0, 100);
        echo '<p class="card-text">' .  $partie_description . '</p>';
        $dateDebut = date('d/m/Y', strtotime($row['datedebut_projet_tut']));
        $dateFin = date('d/m/Y', strtotime($row['datefin_projet_tut']));
        echo '<span class="badge badge-secondary bg-white text-dark border border-dark">Date de début : ' . $dateDebut . '</span>';
        echo '<span class="badge badge-secondary bg-white text-dark border border-dark">Date de fin : ' . $dateFin . '</span>';
        $pdfURL = '../assets/pdf/' . $row['pdf_projet_tut'];
        echo '<br />';
        echo '<a href="' . $pdfURL . '" target="_blank"" class="btn btn-primary">En savoir plus </a>';
        
       
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
      echo '</div>';

      // Afficher les boutons suivants seulement après l'ajout de trois projets
      if ($numProjet > 3) {
        echo '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">';
        echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
        echo '<span class="visually-hidden"></span>';
        echo '</button>';
        echo '<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">';
        echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
        echo '<span class="visually-hidden"></span>';
        echo '</button>';
      }
      echo '</div>';
    } catch (PDOException $e) {
      $message = "Echec de la récupération des éléments : " . $e->getMessage();
    }

    $conn = null;
  }
  ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="../script/AfficherProjet.js"></script>
</body>

</html>