<!DOCTYPE html>

<html lang="FR">

    <?php
        include '../modele/connexionBd.php';
        session_start();
    ?>

    <head>

        <meta charset="utf-8">

        <!-- https://getbootstrap.com/docs/5.3/getting-started/introduction/ -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="../bootstrap/js/bootstrap.min.js"></script>

        <!-- Autres CSS -->
        <link href="../css/edt.css" rel="stylesheet">

    </head>

    <body>

    <?php include 'header.php'; ?>

    <!-- début du contenu de la page -->

    <?php
        echo 'Bienvenue ' . $_SESSION['nom'] . ' ' . $_SESSION['prenom'] . ' !';

        // voir les dernières notes
        $limit = 1;
        include '../modele/student/getMarks.php';

        // voir l'emplois du temps
        include '../modele/student/getEdt.php';
    ?>

    <!-- fin du contenu de la page -->

    <?php include 'footer.php'; ?>

</body>

</html>
