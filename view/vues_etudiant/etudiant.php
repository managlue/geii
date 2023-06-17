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
    <?php include 'menu.php'; ?>

    <div class="container-fluid">
        <div class="page-content p-5 mt-3 mb-3" id="content">

            <table style="width: 100%">
                <colgroup>
                    <col style="width: 70%;">
                    <col style="width: 30%;">
                </colgroup>
                <tr>
                    <td>
                        <!-- Toggle button -->
                        <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-3 mb-4" onclick="toggleIcon()">
                            <i id="icon" class="fa fa-angle-double-left fa-2x"></i>
                        </button>
                        <?php echo '<span class="fs-1">Bienvenue ' . $_SESSION['nom'] . ' ' . $_SESSION['prenom'] . ' !</span>'; ?>
                    </td>
                    <td rowspan="4">
                        <?php
                            // voir l'emplois du temps
                            $today = true;
                            include '../../modele/etudiant/getEdt.php';
                        ?>
                    </td>
                </tr>
                <tr><td>
                    <?php
                        // voir les dernières notes
                        $limit = 3;
                        include '../../modele/etudiant/getMarks.php';
                    ?>
                </td></tr>
                <tr><td>
                    <?php
                        // voir les supports de cours
                        $limit = 3;
                        include '../../modele/etudiant/getSupportCours.php';
                    ?>
                </td></tr>
                <tr><td>
                    <!--
                        un caractere invisible pour que l'emploi du temps soit de la bonne taille
                        si je savais comment faire un truc plus propre je n'utiliserais pas un tableau alors ne critiquez pas svp '^^
                    --> ㅤ
                </td></tr>
            </table>

        </div>
    </div>

    <!-- <?php include '../footer.php'; ?> -->
    
</body>

</html>
