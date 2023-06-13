<!DOCTYPE html>
<html lang="FR">

<head>
    <meta charset="utf-8">
    <title>Site web GEII</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
    <link href="../../bootstrap-5.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="../../bootstrap-5.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../css/Footer/style.css">

    <style>
        p {
            font-family: 'Poppins', sans-serif;
        }

        .carousel-inner {
            position: relative;
        }

        .carousel-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.45);
            /* Couleur de fond légèrement noire */
            padding: 20px;
            color: #fff;
        }
    </style>

</head>

<body>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ul class="carousel-indicators">
            <span data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></span>
            <span data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></span>
            <span data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></span>
        </ul>


        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../../assets/slider/1.png" class="d-block" alt="Image 1">
                <div class="carousel-caption">
                    <h3>Bienvenue sur le site du Département GEII ! 🏫 </h3>
                    <p>Formations, Cursus, Lieux & autres informations à disposition !</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../../assets/slider/2.png" class="d-block" alt="Image 2">
                <div class="carousel-caption">
                    <h3>Découvrez nos Formations ! 🌐 </h3>
                    <p>DUT, Licences & Formations complètes </p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../../assets/slider/3.png" class="d-block" alt="Image 3">
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

    <script src="../../bootstrap-5.3/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<?php  
    include '../footer.php';
?>

