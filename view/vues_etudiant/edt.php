<!DOCTYPE html>

<html lang="FR">

    <?php
        include '../../modele/connexionBd.php';
        session_start();
    ?>

    <head>
        <meta charset="utf-8">

    <!-- https://getbootstrap.com/docs/5.3/getting-started/introduction/ -->
    <link href="/geii/bootstrap-5.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="/geii/bootstrap-5.3/js/bootstrap.min.js"></script>

    <!-- Autres JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/geii/script/etudiant/boutonMenu.js"></script>
    <script src="/geii/script/etudiant/faviconSwap.js"></script>

    <!-- https://fontawesome.com/v4/icons/ -->
    <link href="/geii/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Autres CSS -->
    <link href="/geii/css/Etudiant_CSS/edt.css" rel="stylesheet">
    <link href="/geii/css/Etudiant_CSS/menu.css" rel="stylesheet">

    </head>

    <body>

    <?php include '../header.php'; ?>

    <!-- Page content holder -->
    <div class="page-content p-5" id="content">

        <!-- Toggle button -->
        <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-3 mb-4" onclick="toggleIcon()">
            <i id="icon" class="fa fa-angle-double-left fa-2x"></i>
        </button>

        <!-- content -->

        <?php include 'menu.php'; ?>

        <!-- début du contenu de la page -->

        <?php

            echo '<span class="fs-1">Bienvenue ' . $_SESSION['nom'] . ' ' . $_SESSION['prenom'] . ' !</span>';

            // voir l'emplois du temps
            include '../../modele/etudiant/getEdt.php';
        ?>

        <!-- fin du contenu de la page -->
    </div>

    <?php include '../footer.php'; ?>

</body>

</html>
