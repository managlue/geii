<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Admin</title>
    <link href="../../bootstrap-5.3/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../../css/Admin_CSS/Style_Admin.css" rel="stylesheet" />
</head>

<body>
    <?php
    include '../header.php';
    include '../../modele/admin/Afficher/Afficher_Enseignant.php';
    // include 'Afficher_Offre.php';
    // include 'Afficher_projet.php';
    include '../../modele/admin/Afficher/Afficher_Etudiant.php';
    include '../../modele/admin/Afficher/Afficher_Entreprise.php';
    ?>
   

    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Enseignant</h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="Ajouter/AjoutEnseignant/AjoutEnseignant.php" class="btn btn-success" data-toggle="modal">
                                <i class="material-icons">&#xE147;</i> <span>Ajouter Enseignant</span>
                            </a>
                            <a href="SupprimerALL.php" class="btn btn-danger" data-toggle="modal">
                                <i class="material-icons">&#xE15C;</i> <span>Supprimer ALL</span>
                            </a>
                        </div>
                    </div>
                </div>
                <table id="enseignantTable" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                                </span>
                            </th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Classe</th>
                            <th>Identifiant</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($enseignants as $enseignant) : ?>
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="<?php echo $enseignant['id_enseignant']; ?>" name="options[]" value="<?php echo $enseignant['id_enseignant']; ?>">

                                        <label for="<?php echo $enseignant['id_enseignant']; ?>"></label>
                                    </span>
                                </td>
                                <td><?php echo $enseignant['nom_enseignant']; ?></td>
                                <td><?php echo $enseignant['prenom_enseignant']; ?></td>
                                <td><?php echo $enseignant['nom_classe']; ?></td>
                                <td><?php echo $enseignant['login_enseignant']; ?></td>
                                <td>
                                <a href="Modifier/ModifierEnseignant/ModifierEnseignant.php?id=<?php echo $enseignant['id_enseignant']; ?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Modifier">&#xE254;</i></a>
                                <a href="../../modele/admin/Supprimer/SupprimerEnseignant.php?enseignant_id=<?php echo $enseignant['id_enseignant']; ?>" class="delete" ><i class="material-icons"  title="Supprimer">&#xE872;</i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="clearfix">
                    <!-- Affichage de la pagination -->
                    <ul class="pagination">
                        <li class="page-item <?php echo ($pageActuelle_Enseignant == 1) ? 'disabled' : ''; ?>">
                            <a href="?page_enseignant=<?php echo ($pageActuelle_Enseignant > 1) ? ($pageActuelle_Enseignant - 1) : 1; ?>">Précédent</a>
                        </li>
                        <?php
                        foreach (range(1, $totalPages) as $page) : ?>
                            <li class="page-item <?php echo ($pageActuelle_Enseignant == $page) ? 'active' : ''; ?>">
                                <a href="?page_enseignant=<?php echo $page; ?>"><?php echo $page; ?></a>
                            </li>
                        <?php endforeach; ?>
                        <li class="page-item <?php echo ($pageActuelle_Enseignant == $totalPages) ? 'disabled' : ''; ?>">
                            <a href="?page_enseignant=<?php echo ($pageActuelle_Enseignant < $totalPages) ? ($pageActuelle_Enseignant + 1) : $totalPages; ?>" >Suivant</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Etudiant -->

    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Etudiant</h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="scripts/scriptAddStudentsTeachersToDB.php" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Ajouter Etudiant</span></a>
                            <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Supprimer ALL</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                                </span>
                            </th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Classe</th>
                            <th>Identifiant</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($etudiants as $etudiant) : ?>
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="<?php echo $etudiant['id_etudiant']; ?>" name="options[]" value="<?php echo $etudiant['id_etudiant']; ?>">

                                        <label for="<?php echo $etudiant['id_etudiant']; ?>"></label>
                                    </span>
                                </td>
                                <td><?php echo $etudiant['nom_etudiant']; ?></td>
                                <td><?php echo $etudiant['prenom_etudiant']; ?></td>
                                <td><?php echo $etudiant['nom_classe']; ?></td>
                                <td><?php echo $etudiant['login_etudiant']; ?></td>
                                <td>
                                <a href="Modifier/ModifierEtudiant/ModifierEtudiant.php?etudiant_id=<?php echo $etudiant['id_etudiant']; ?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Modifier">&#xE254;</i></a>
                                <a href="../../modele/admin/Supprimer/SupprimerEtudiant.php?etudiant_id=<?php echo $etudiant['id_etudiant']; ?>" class="delete" ><i class="material-icons"  title="Supprimer">&#xE872;</i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
                <div class="clearfix">
                    <!-- Affichage de la pagination -->
                    <ul class="pagination">
                        <li class="page-item <?php echo ($pageActuelle_Etudiant == 1) ? 'disabled' : ''; ?>">
                            <a href="?page_etudiant=<?php echo ($pageActuelle_Etudiant > 1) ? ($pageActuelle_Etudiant - 1) : 1; ?>">Précédent</a>
                        </li>
                        <?php
                        foreach (range(1, $totalPages_Etudiant) as $page) : ?>
                            <li class="page-item <?php echo ($pageActuelle_Etudiant == $page) ? 'active' : ''; ?>">
                                <a href="?page_etudiant=<?php echo $page; ?>"><?php echo $page; ?></a>
                            </li>
                        <?php endforeach; ?>
                        <li class="page-item <?php echo ($pageActuelle_Etudiant == $totalPages_Etudiant) ? 'disabled' : ''; ?>">
                            <a href="?page_etudiant=<?php echo ($pageActuelle_Etudiant < $totalPages_Etudiant) ? ($pageActuelle_Etudiant + 1) : $totalPages_Etudiant; ?>" >Suivant</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Entreprise -->

    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Entreprise</h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="Ajouter/AjoutEntreprise/AjouterEntreprise.php" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Ajouter Entreprise</span></a>
                            <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Supprimer ALL</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                                </span>
                            </th>
                            <th>Nom</th>
                            <th>N° Téléphone</th>
                            <th>E-Mail</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($entreprises as $entreprise) : ?>
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="<?php echo $entreprise['id_entreprise']; ?>" name="options[]" value="<?php echo $entreprise['id_entreprise']; ?>">

                                        <label for="<?php echo $entreprise['id_entreprise']; ?>"></label>
                                    </span>
                                </td>
                                <td><?php echo $entreprise['nom_entreprise']; ?></td>
                                <td><?php echo chunk_split($entreprise['tel_entreprise'], 2, ' '); ?></td>
                                <td><?php echo $entreprise['mail_entreprise']; ?></td>
                                
                                <td>
                                <a href="Modifier/ModifierEntreprise/ModifierEntreprise.php?entre_id=<?php echo $entreprise['id_entreprise']; ?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Modifier">&#xE254;</i></a>
                                <a href="../../modele/admin/Supprimer/SupprimerEntreprise.php?entreprise_id=<?php echo $entreprise['id_entreprise']; ?>" class="delete" ><i class="material-icons"  title="Supprimer">&#xE872;</i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
                <div class="clearfix">
                    <ul class="pagination">
                        <li class="page-item <?php echo ($pageActuelle_entreprise == 1) ? 'disabled' : ''; ?>">
                            <a href="?page_entreprise=<?php echo ($pageActuelle_entreprise > 1) ? ($pageActuelle_entreprise - 1) : 1; ?>">Précédent</a>
                        </li>
                        <?php
                        foreach (range(1, $totalPages_entreprise) as $page) : ?>
                            <li class="page-item <?php echo ($pageActuelle_entreprise == $page) ? 'active' : ''; ?>">
                                <a href="?page_entreprise=<?php echo $page; ?>"><?php echo $page; ?></a>
                            </li>
                        <?php endforeach; ?>
                        <li class="page-item <?php echo ($pageActuelle_entreprise == $totalPages_entreprise) ? 'disabled' : ''; ?>">
                            <a href="?page_entreprise=<?php echo ($pageActuelle_entreprise < $totalPages_entreprise) ? ($pageActuelle_entreprise + 1) : $totalPages_entreprise; ?>" >Suivant</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.getElementById('selectAll').addEventListener('change', function() {
        var checkboxes = document.getElementsByName('options[]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked;
        }
    });
</script>
<link href="../../bootstrap-5.3/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="../../bootstrap-5.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

</body>

</html>