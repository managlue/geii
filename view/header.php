<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  
  
</head>
<?php

  $menuConnexion = "";
  if (isset($_SESSION['id_entreprise'])) {
    $menuConnexion = "<li class='nav-item'><a class='nav-link' href='deconnexion.php'>Déconnexion</a></li>\n";
  } else {
    $menuConnexion = "<li class='nav-item'><a class='nav-link' href='AccueilEnt.php'>Espace Entreprise</a></li>\n";
  }
  ?>


<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <?php
  
  if (isset($_SESSION['id_entreprise'])) {
      // L'entreprise est connectée, affiche le champ "Ajouter une offre"
      echo '<li class="nav-item">
              <a class="nav-link" href="AjouterOffre.php">Publier une offre</a>
            </li>';
            echo '<li class="nav-item">
            <a class="nav-link" href="ModifierOffre.php">Modifier une offre</a>
          </li>';
          echo '<li class="nav-item dropdown">';
          echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gérer les offres et projets</a>';
          echo '<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
          echo '<a class="dropdown-item" href="AfficherOffreBD.php">Afficher les offres</a>';
          echo '<a class="dropdown-item" href="AjouterProjet.php">Ajouter un projet</a>';
          echo '<a class="dropdown-item" href="AfficherProjet.php">Afficher les projets</a>';
          echo '</div>';
          echo '</li>';
  }
  ?>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown button
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
</div>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <?php
        echo $menuConnexion;
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
        
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>