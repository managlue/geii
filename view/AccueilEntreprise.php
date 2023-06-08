<!-- <?php
session_start();
?> -->
<!DOCTYPE html>
<html>

<head>
    <title>Espace entreprise</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/StyleAEntreprise.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<body>
    <div class="header-nightsky">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar" aria-controls="myNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                        <a class="nav-link" href="accueil.php">Notre Formation</a>
                        </li>
                        <li class="nav-item">
                        
                        <a class="nav-link" href="AccueilEnt.php">Espace Entreprise</a>
                        </li>
                        <?php
                        if (isset($_SESSION['id_entreprise'])) {
                            echo '
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle"  id="offreDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Offre Entreprise
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="offreDropdown">
                                    <li><a class="dropdown-item" href="AjouterOffre.php">Publier une offre</a></li>
                                    <li><a class="dropdown-item" href="AfficherOffreBD.php">Afficher les offres</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle"  id="projetDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Projets Tutorés
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="projetDropdown">
                                    <li><a class="dropdown-item" href="AjouterProjet.php">Ajouter un projet</a></li>
                                    <li><a class="dropdown-item" href="AfficherProjet.php">Afficher les projets</a></li>
                                </ul>
                            </li>';
                        }
                        ?>
                        
                        <?php
                        $menuConnexion = "";
                      
                        if (isset($_SESSION['id_entreprise'])) {

                            echo '<li class="nav-item dropdown">';
                            echo '<a class="nav-link dropdown-toggle"  id="menuConnexionDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">';
                            echo 'Bienvenue, ' . $_SESSION['nom_entreprise'];
                            echo '</a>';
                            echo '<ul class="dropdown-menu" aria-labelledby="menuConnexionDropdown">';
                            echo '<li><a class="dropdown-item" href="deconnexion.php">Déconnexion</a></li>';
                            echo '</ul>';
                            echo '</li>'; 
                        } 
                        echo $menuConnexion;
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="hero">
            <h1>Espace Entreprise</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="AccueilEnt.php">Espace entreprise</a></li>
                </ol>
            </nav>
        </div>
        
        <section class="wrapper">
  <div class="container-fostrap">
    <div>
      <h1 class="heading">Projets Récemment ajoutés</h1>
    </div>

    <?php
if (isset($_SESSION['id_entreprise'])) {
  try {
    $host = "localhost";
    $dbname = "id20742082_geii";
    $user = "root";
    $pass = "";

    $conn = new PDO("mysql:host=$host;dbname=$dbname", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM projet_tut JOIN entreprise ON projet_tut.id_entreprise = entreprise.id_entreprise WHERE projet_tut.id_entreprise = :id_entreprise ORDER BY dateajout_projet_tut DESC LIMIT 3");
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
        $imageURL = '../assets/img/' . $row['image_projet_tut'];
        echo '<img src="' . $imageURL . '" />';
        echo '</a>';
        echo '<div class="card-content">';
        echo '<h4 class="card-title">';
        echo '<a >'. $row['titre_projet_tut'].'</a>';
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
    echo "Echec de la récupération des projets : " . $e->getMessage();
  }

  $conn = null;
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
        $host = "localhost";
        $dbname = "id20742082_geii";
        $user = "root";
        $pass = "";

        $conn = new PDO("mysql:host=$host;dbname=$dbname", 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM offre_alternance JOIN entreprise ON offre_alternance.id_entreprise = entreprise.id_entreprise WHERE offre_alternance.id_entreprise = :id_entreprise ORDER BY date_ajout DESC LIMIT 3");
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
            $imageURL = '../assets/img/' . $row['image'];
            echo '<img src="' . $imageURL . '" />';
            echo '</a>';
            echo '<div class="card-content">';
            echo '<h4 class="card-title">';
            echo '<a >'. $row['titre_offre'].'</a>';
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
        echo "Echec de la récupération des offres : " . $e->getMessage();
      }

      $conn = null;
    } else {
      echo '<p>Connectez-vous pour voir les offres récemment ajoutées.</p>';
    }
    ?>
  </div>
</section>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>