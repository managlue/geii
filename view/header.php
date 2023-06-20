<!DOCTYPE html>
<html>

<head>
  <title>Menu</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css">
  <style>
    header {
      font-family: "Poppins", sans-serif;
    }
  </style>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-md bg-light bsb-navbar bsb-navbar-hover bsb-navbar-caret">
      <div class="container">
        <a class="navbar-brand" href="/geii/accueil.php">
          <img src="\geii\assets\icons\GEII.png" alt="" width="124" height="69">
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
          </svg>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>

          <div class="offcanvas-body text-center"> <!-- Ajout de la classe text-center -->
            <ul class="navbar-nav justify-content-end flex-grow-1">
              <button class="btn" type="button">
                <a class="link-dark link-underline link-underline-opacity-0 text-decoration-none" href="/geii/accueil.php">Accueil</a>
              </button>

              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Formations
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/geii/view/vues_formation/geii.php">BUT Génie Electrique</a></li>
                  <li><a class="dropdown-item" href="/geii/view/vues_formation/miaw.php">LP Application Web</a></li>
                  <li><a class="dropdown-item" href="/geii/view/vues_formation/cimisigd.php">LP Cybersécurité & Systèmes d'Informations</a></li>
                </ul>
              </div>

              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Entreprise
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/geii/view/vues_entreprise/AccueilEnt.php">Accueil Entreprise</a></li>
                  <?php if (isset($_SESSION['id_entreprise'])) { ?>
                    <li><a class="dropdown-item" href="/geii/view/vues_entreprise/AjouterOffre.php">Publier une offre</a></li>
                    <li><a class="dropdown-item" href="/geii/view/vues_entreprise/AfficherOffreBD.php">Afficher les offres</a></li>
                    <li><a class="dropdown-item" href="/geii/view/vues_entreprise/AjouterProjet.php">Ajouter un projet</a></li>
                    <li><a class="dropdown-item" href="/geii/view/vues_entreprise/AfficherProjet.php">Afficher les projets</a></li>
                  <?php } else { ?>
                    <li><a class="dropdown-item" href="/geii/view/vues_entreprise/co.php">Vous connecter</a></li>
                  <?php } ?>
                </ul>
              </div>

              <?php
              $menuConnexion = "";

              if (isset($_SESSION['id_entreprise'])) { ?>

                <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo 'Bienvenue, ' . $_SESSION['nom_entreprise']; ?>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/geii/view/vues_entreprise/deconnexion.php">Déconnexion</a></li>
                  </ul>
                </div>

              <?php }
              echo $menuConnexion; ?>

              <?php if (isset($_SESSION['identifiant'])) {  ?>
                <button class="btn" type="button">
                  <a class="link-dark link-underline link-underline-opacity-0 text-decoration-none" href="/geii/view/vues_entreprise/deconnexion.php">Déconnexion</a>
                </button>

              <?php } else { ?>
                <button class="btn" type="button">
                  <a class="link-dark link-underline link-underline-opacity-0 text-decoration-none" href="/geii/modele/login.php">Se connecter</a>
                </button>
              <?php }  ?>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
</body>

</html>