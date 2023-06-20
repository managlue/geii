<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Espace entreprise</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../css/Entreprise_CSS/styleAccueilEntreprise.css">
    <!-- <link rel="stylesheet" href="../../css/Footer/style.css"> -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<body>
    <?php include "../header.php"?>

<div class="header-nightsky"></div>
    <div class="hero">
        <h1>Espace Entreprise</h1>
    </div>
    </div>
    <div class="container text-center">
    <h2>Nos partenaires</h2>
        <div class="row justify-content-center">
            <div class="col-md">
                <img src="../../assets/img/Partenaire/rexel.png" alt="Rexel France" class="fab img-fluid mx-auto">
            </div>
            <div class="col-md">
                <img src="../../assets/img/Partenaire/xfab.png" alt="X-FAB France" class="fab img-fluid mx-auto">
            </div>
            <div class="col-md">
                <img src="../../assets/img/Partenaire/Safran.png" alt="Safran Electrical & Power" class="fab img-fluid mx-auto">
            </div>
            <div class="col-md">
                <img src="../../assets/img/Partenaire/manpower.png" alt="Manpower France" class="fab img-fluid mx-auto">
            </div>
        </div>
    </div>
<br />
    <div class="container">
        <h1>Etre partenaire de l'IUT, c'est...</h1>

        <ul>
            <li>Contribuer à la formation universitaire et technologique de vos futurs collaborateurs.</li>
            <li>Offrir aux étudiants en formation la possibilité de mettre en pratique leurs connaissances et de se professionnaliser.</li>
            <li>Accueillir un jeune en alternance</li>
            <li>Proposer une mission qu’un groupe d’étudiants réalisera sous la tutelle d’un enseignant (Projet Tutoré Collectif)</li>
        </ul>
    </div>

    <div class="container-possibilite">
        <div class="row justify-content-center">
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
                        <h4>Proposer un projet tutoré</h4>
                    </div>
                    <div class="text">
                        <span>Nous sommes ouverts à toutes propositions de projet tutoré pour nos étudiants. Que vous soyez une entreprise, une organisation ou une institution, nous vous encourageons à soumettre vos idées de projet.
                            Le projet tutoré offre une excellente occasion de collaborer avec nos étudiants talentueux et motivés. Ils sont prêts à mettre en pratique leurs connaissances et compétences.</span>
                    </div>
                    <a href="co.php">Proposer des projets</a>
                </div>
            </div>
        </div>
    </div>

    <?php include "../footer.php"?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </div>
</body>

</html>
