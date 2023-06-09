<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Espace entreprise</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/Entreprise_CSS/styleAccueilEntreprise.css">
    
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
                            <a class="nav-link" href="../accueil.php">Notre Formation</a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link" href="AccueilEnt.php">Espace Entreprise</a>
                         
                        </li>
                        <!-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle"  id="offreDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Se Connecter
                                </a> -->
                              

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
                            echo '<a class="nav-link dropdown-toggle" id="menuConnexionDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">';
                            echo 'Bienvenue, ' . $_SESSION['nom_entreprise'];
                            echo '</a>';
                            echo '<ul class="dropdown-menu" aria-labelledby="menuConnexionDropdown">';
                            echo '<li><a class="dropdown-item" href="deconnexion.php">Déconnexion</a></li>';
                            echo '</ul>';
                            echo '</li>';     } else {
                                $menuConnexion = '<li class="nav-item dropdown">';
                                $menuConnexion .= '<a class="nav-link dropdown-toggle" id="menuConnexionDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
                                $menuConnexion .= 'Se Connecter';
                                $menuConnexion .= '</a>';
                                $menuConnexion .= '<ul class="dropdown-menu" aria-labelledby="menuConnexionDropdown">';
                                
                                $menuConnexion .= '<li><a class="dropdown-item" href="#1">Elèves / Enseignant</a></li>';
                                $menuConnexion .= '<li><a class="dropdown-item"href="co.php">Entreprise</a></li>';
                                $menuConnexion .= ' <li><a class="dropdown-item" href="#">Personnel</a></li>';
                                $menuConnexion .= '</ul>';
                                $menuConnexion .= '</li>';
                            // <li class='nav-item'><a class='nav-link' href='co.php'>Connexion</a></li>\n";
                        }
                        echo $menuConnexion;
                        ?>
                         
                    </ul>
                </div>
            </div>
        </nav>
        <div class="hero">
            <h1>Espace Entreprise</h1>
            <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="AccueilEnt.php">Espace entreprise</a></li>
                </ol>
            </nav> -->
        </div>

        <div class="container">
            <h1>Depuis sa création, notre IUT a établi des liens privilégiés et un partenariat solide avec les entreprises et les organisations locales, conformément à sa nature et à sa mission.</h1>
            <p>Etre partenaire de l'IUT, c'est...</p>
            <ul>
                <li>Participer à la formation universitaire et technologique de vos futurs collaborateurs</li>
                <li>Permettre la professionnalisation des jeunes en formation en leur offrant la possibilité de mettre en pratique leurs savoirs</li>
                <li>Accueillir un jeune en alternance</li>
                <li>Proposer une mission qu’un groupe d’étudiants réalisera sous la tutelle d’un enseignant (Projet Tutoré Collectif)</li>
            </ul>
        </div>





        <div class="container-possibilite">
            <div class="row">

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                    <div class="box-part ">
                

                        <div class="title">
                            <h4>Proposer une offre d'alternace</h4>
                        </div>

                        <div class="text">
                            <span>Recruter de jeunes talents en alternance est un enjeu essentiel pour permettre à votre entreprise de continuer à évoluer et de se renouveler. En proposant des offres d'alternance, vous avez l'opportunité de former et d'intégrer des étudiants motivés, dynamiques et désireux d'apprendre.</span>
                        </div>

                        <a href="co.php">Proposer votre offre</a>

                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                    <div class="box-part ">

                      
                        <div class="title">
                            <h4>Proposer un projet Tutoré</h4>
                        </div>

                        <div class="text">
                            <span>Nous sommes ouverts à toutes propositions de projet tutoré pour nos étudiants. Que vous soyez une entreprise, une organisation ou une institution, nous vous encourageons à soumettre vos idées de projet.

Le projet tutoré offre une excellente occasion de collaborer avec nos étudiants talentueux et motivés. Ils sont prêts à relever des défis et à mettre en pratique leurs connaissances et compétences.</span>
                        </div>

                        <a href="co.php">Proposer des projets</a>

                    </div>
                </div>






            </div>
        </div>
    </div>

    <!-- <section class="contenue">
            <div class="contenue-card">
                <div class="contenue-left">
                    <img alt="" src="../assets/Offre alternace.jpg">
                </div>
                <div class="contenue-right">
                    <h1>Recrutez de jeunes talents</h1>
                    <p>
                    Stagiaires, alternants ou jeunes diplômés : recrutez dès maintenant vos futurs collaborateurs !

Le recrutement de jeunes talents revêt une importance cruciale pour assurer la croissance et l'évolution de votre entreprise. En engageant des stagiaires, des alternants ou des jeunes diplômés, vous pouvez bénéficier de leur enthousiasme, de leur motivation et de leur volonté d'apprendre.
Les alternants constituent également une force vive pour votre entreprise. Ils ont la possibilité de mettre en pratique leurs connaissances théoriques tout en étant encadrés par des professionnels expérimentés. Ces programmes d'alternance permettent de former des talents sur mesure, adaptés aux spécificités de votre entreprise et de votre secteur d'activité. En recrutant des alternants, vous investissez dans l'avenir de votre entreprise en formant les collaborateurs qui pourront éventuellement intégrer vos équipes de manière pérenne.

                    </p>
                </div>
            </div>
            <div class="contenue-card">
                <div class="contenue-left">
                    <img alt="" src="../assets/projet tutore.jpg">
                </div>
                <div class="contenue-right">
                    <h1>Géolocalisation</h1>
                    <p>Pour obtenir les données GPS d'un ou plusieurs ruchers, j'ai d'abord dû déterminer le port (/ttyUSB0) sur lequel se trouve le récepteur GPS. Une fois le port identifié, j'ai ouvert le fichier '/dev/ttyUSB0' en mode lecture à l'aide de la fonction de bas niveau open(). Ce fichier contient toutes les trames GPS fournies par le récepteur. J'ai ainsi pu extraire toutes les trames de type GPGGA (trame NMEA) avec les différents champs tels que la latitude et la longitude. De plus, j'ai converti les données obtenues en format Google Maps, afin de permettre à l'apiculteur de visualiser plus rapidement l'emplacement de ses ruchers.</p>
                </div>
            </div>
        </section> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</body>

</html>