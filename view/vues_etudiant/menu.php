<div class="vertical-nav bg-white" id="sidebar">
    <div class="py-4 px-3 mb-4 bg-light">
        <div class="media d-flex align-items-center">
            <div class="media-body">
                <a class="navbar-brand" href="/geii/accueil.php">
                    <img src="\geii\assets\icons\GEII.png" alt="" width="124" height="69">
                </a>

<?php
    echo '<h4 class="m-0">' . $_SESSION['nom'] . ' ' . $_SESSION['prenom'] . '</h4>';
?>

            </div>
        </div>
    </div>

    <ul class="nav flex-column bg-white mb-0">
    <li class="nav-item">
            <a href="etudiant.php" class="nav-link text-dark font-italic bg-light">
                <i class="fa fa-home mr-3 text-primary fa-fw"></i>
                Accueil
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link text-dark font-italic bg-light">
                <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                Profil
            </a>
        </li>
        <li class="nav-item">
            <a href="notes.php" class="nav-link text-dark font-italic">
                <i class="fa fa-graduation-cap mr-3 text-primary fa-fw"></i>
                Notes
            </a>
        </li>
        <li class="nav-item">
            <a href="support-cours.php" class="nav-link text-dark font-italic">
                <i class="fa fa-book mr-3 text-primary fa-fw"></i>
                Supports de cours
            </a>
        </li>
        <li class="nav-item">
            <a href="edt.php" class="nav-link text-dark font-italic">
                <i class="fa fa-calendar mr-3 text-primary fa-fw" aria-hidden="true"></i>
                Emploi du temps</a>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link text-dark font-italic">
                <i class="fa fa-laptop mr-3 text-primary fa-fw"></i>
                Projets tutorés
            </a>
        </li>
        <li class="nav-item">
            <a href="offres-alt.php" class="nav-link text-dark font-italic">
                <i class="fa fa-handshake-o mr-3 text-primary fa-fw"></i>
                Offres d'alternances
            </a>
        </li>
    </ul>
</div>