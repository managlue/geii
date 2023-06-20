<!DOCTYPE html>
<html lang="FR">

    <?php
        include '../../modele/connexionBd.php';
        session_start();
    ?>

<head>
    <title>Notes <?php echo $_SESSION['nom'] . ' ' . $_SESSION['prenom']; ?></title>
    <meta charset="utf-8">

    <!-- https://getbootstrap.com/docs/5.3/getting-started/introduction/ -->
    <link href="/geii/bootstrap-5.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="/geii/bootstrap-5.3/js/bootstrap.min.js"></script>

    <!-- les bootstrap en ligne pour les dropdown -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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

    <div class="page-content p-5" id="content">

        <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-3 mb-4" onclick="toggleIcon()">
            <i id="icon" class="fa fa-angle-double-left fa-2x"></i>
        </button>

        <?php include 'menu.php'; ?>

        <?php
            echo '<span class="fs-1">Bienvenue ' . $_SESSION['nom'] . ' ' . $_SESSION['prenom'] . ' !</span><br><br>';
            include '../../modele/etudiant/getAlternance.php';
        ?>

    </div>

    <?php include '../footer.php'; ?>

</body>
</html>
