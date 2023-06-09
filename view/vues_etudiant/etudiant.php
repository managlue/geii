<!DOCTYPE html>

<html lang="FR">

    <?php
        include '../../modele/connexionBd.php';
        session_start();
    ?>

    <head>
        <meta charset="utf-8">

        <!-- https://getbootstrap.com/docs/5.3/getting-started/introduction/ -->
        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="../../bootstrap/js/bootstrap.min.js"></script>

        <!-- Autres JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../../script/etudiant/boutonMenu.js"></script>

        <!-- Autres CSS -->
        <link href="../../css/Etudiant_CSS/edt.css" rel="stylesheet">
        <link href="../../css/Etudiant_CSS/menu.css" rel="stylesheet">


    </head>

    <body>

    <?php include '../header.php'; ?>

    <!-- Page content holder -->
    <div class="page-content p-5" id="content">

        <!-- Toggle button -->
        <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4">
            <i class="fa fa-bars mr-2"></i>
            <small class="text-uppercase font-weight-bold">Toggle</small>
        </button>

        <!-- content -->

        <?php include 'menu.php'; ?>

        <!-- début du contenu de la page -->

        <?php
            echo 'Bienvenue ' . $_SESSION['nom'] . ' ' . $_SESSION['prenom'] . ' !';

            // voir les dernières notes
            $limit = 1;
            include '../../modele/etudiant/getMarks.php';

            // voir l'emplois du temps
            $today = true;
            include '../../modele/etudiant/getEdt.php';

            // voir les supports de cours
            // include '../modele/etudiant/.php';
        ?>

        <!-- fin du contenu de la page -->
    </div>

    <?php include '../footer.php'; ?>

</body>

</html>
