<!DOCTYPE html>
<html lang="FR">

<head>
    <meta charset="utf-8">
    <title>Site web GEII</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
    <link href="bootstrap-5.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap-5.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/Footer/style.css">
    <link rel="stylesheet" href="css/Static_CSS/accueil.css">

</head>

<?php
include 'view/header.php';
?>

<body>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ul class="carousel-indicators">
            <span data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></span>
            <span data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></span>
            <span data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></span>
        </ul>


        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/slider/1.png" class="d-block" alt="Image 1">
                <div class="carousel-caption">
                    <h3>Bienvenue sur le site du Département GEII ! 🏫 </h3>
                    <p>Formations, Cursus, Lieux & autres informations à disposition !</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/slider/2.png" class="d-block" alt="Image 2">
                <div class="carousel-caption">
                    <h3>Découvrez nos Formations ! 🌐 </h3>
                    <p>DUT, Licences & Formations complètes </p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/slider/3.png" class="d-block" alt="Image 3">
                <div class="carousel-caption">
                    <h3>Programme 📚</h3>
                    <p>Cursus, Cours & bloc de compétences en détails </p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Précédent</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Suivant</span>
        </a>
    </div>

    <script src="bootstrap-5.3/js/bootstrap.bundle.min.js"></script>

    </br>

    <div class="titre">
        <p> <b> <i> Nos Formations </i> </b> 🌐 </p>
    </div>


    <div class="card-group">

        <div class="card zoom-effect">
            <a href="view/vues_formation/geii.php">
                <img src="assets/img/BUT.jpg" class="card-img-top" alt="...">
                <div class="card-body">

                    <h5 class="card-title">BUT Génie Électrique et Informatique Industrielle (GEII)</h5>
            </a>
            <p class="card-text">La formation dispensée dans les départements Génie Électrique et Informatique
                Industrielle (GEII) est construite par une communauté au sein de laquelle coopèrent enseignants
                et professionnels de l’industrie et des services. Elle constitue un dispositif national
                universitaire qui prépare en 3 ans l’étudiant à l’insertion professionnelle tout en lui laissant
                la possibilité de poursuivre ses études.</p>
        </div>
        <div class="card-footer">
            <small class="text-body-secondary">⌛ Durée de la formation : 3 ans | Initiale ou alternance</small>
        </div>
    </div>


    <div class="card zoom-effect">
        <a href="view/vues_formation/miaw.php">
            <img src="assets/img/MIAW.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">LP Métiers de l’informatique : applications web</h5>
        </a>
        <p class="card-text">La Licence Métiers de l’Informatique: Applications Web propose deux parcours pour
            former des jeunes de niveau BAC+2 aux métiers de l’Internet et de responsable informatique. La
            formation MIAW d’une manière générale a des objectifs scientifiques et surtout professionnels bien
            identifiés et s’inscrit avec ses deux parcours (MIAW ASR2I) et (MIAW DAW2I) dans l’offre globale de
            l’établissement.</p>
    </div>
    <div class="card-footer">
        <small class="text-body-secondary">⌛ Durée de la formation : 1 an | En alternance </small>
    </div>
    </div>
    <div class="card zoom-effect">
        <a href="view/vues_formation/cimisigd.php">
            <img src="assets/img/cyber.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">LP Métiers de l’informatique et de cybersécurité – Systèmes d’Information et
                    Gestion des Données</h5>
        </a>
        <p class="card-text">Le diplôme a pour objet de former aux comportements et techniques de conception et
            d’administration destinés à l’analyse, la conception, la mise à disposition et au maintien en
            condition opérationnelle des systèmes d’information.</p>
    </div>
    <div class="card-footer">
        <small class="text-body-secondary">⌛ Durée de la formation : 1 an | En alternance</small>
    </div>
    </div>
    </div>

    <hr>


    <div class="titre">
        <p> <b> <i> Vidéo de présentation (1 min) </i> </b> 📽️ </p>
    </div>




    <div style="display: flex; justify-content: center;">
        <div style="border-radius: 10px; overflow: hidden; box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);">
            <iframe width="854" height="480" src="https://www.youtube-nocookie.com/embed/G98Dlfo-Fvc?controls=0"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
        </div>
    </div>

    </br>

    <hr>

    <div class="row g-0 bg-body-secondary position-relative">
        <div class="col-md-6 mb-md-0 p-md-4">
            <img src="assets/img/iut.png" class="w-100" alt="...">
        </div>
        <div class="col-md-6 p-4 ps-md-0">
            <h5 class="mt-0">Plus d'informations...</h5>
            <p>Les secteurs traditionnels d’activité (industries électriques et électroniques, appareillages et
                instrumentation, production et transport d’énergie, télécommunications, technologies de l’information et
                de la communication) se sont élargis en raison des multiples applications de l’électricité et de
                l’informatique.

                Étant donnée la généralisation de l’électronique et de l’informatique industrielle dans bon nombre
                d’activités, les compétences du diplômé GEII s’exercent dans des secteurs aussi divers que : les
                industries de transformation et manufacturières, la production et la gestion de l’énergie, l’industrie
                électronique, les transports et l’au tomobile, l’aérospatial et la défense, la construction et le
                bâtiment, la santé, l’agroalimentaire et les agro-industries.

                Dans une grande entreprise, dans une petite entreprise ou dans un laboratoire de recherche. Il exerce
                ses fonctions de technicien dans les domaines des études et du développement, de l’industrialisation et
                de la production, de l’au tomatisation, de l’intégration de systèmes, de la maintenance, de l’assurance
                qualité et des services, voire du commerce.

                Les métiers d’électronicien, électrotechnicien, au tomaticien ou technicien de maintenance couvrent une
                large palette d’emplois spécifiques : méthodiste–industrialisateur, chargé d’études, chargé d’affaires,
                chargé d’essais, responsable d’équipes de fabrication, coordonnateur maintenance, développeur,
                concepteur-chargé de gammes, au tomaticien régulation, spécialiste process, informaticien industriel,
                etc.</p>
            <a href="#" class="stretched-link">Accéder aux programmes</a>
        </div>
    </div>


</body>

</html>

<?php
include 'view/footer.php';
?>
