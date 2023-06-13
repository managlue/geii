<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEII - Espace Enseignant</title>
    <!-- https://getbootstrap.com/docs/5.3/getting-started/introduction/ -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/Enseignant_CSS/enseignant.css">
</head>

<body>

    <?php
    include '../../modele/enseignant/notes.php';
    ?>

    <div class="container">
        <h1 class="text-center mt-5">👨‍🏫 GEII - Espace Enseignant 👩‍🏫</h1>

        <form method="get" id="filter-form" class="mt-5">
            <div class="form-group">
                <label for="classe">🏫 Classe :</label>
                <select name="classe" id="classe" class="form-control">
                    <?php foreach ($classes as $classe) { ?>
                        <option value="<?php echo htmlspecialchars($classe['id_classe']); ?>" <?php if ($classe['id_classe'] == $id_classe) {
                               echo 'selected';
                           } ?>><?php echo htmlspecialchars($classe['nom_classe']); ?></option>
                    <?php } ?>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="matiere">📚 Matière :</label>
                <select name="matiere" id="matiere" class="form-control">
                    <?php foreach ($matieres as $matiere) { ?>
                        <option value="<?php echo htmlspecialchars($matiere['id_matiere']); ?>" <?php if ($matiere['id_matiere'] == $id_matiere) {
                               echo 'selected';
                           } ?>><?php echo htmlspecialchars($matiere['nom_matiere']); ?></option>
                    <?php } ?>
                </select>
            </div>
        </form>

        <script>
            window.addEventListener('load', function () {
                if (!sessionStorage.getItem('pageLoaded')) {
                    document.getElementById('filter-form').submit();
                    sessionStorage.setItem('pageLoaded', 'true');
                }
            });

            // Sélectionner les éléments du formulaire
            var filterForm = document.getElementById('filter-form');
            var matiereSelect = document.getElementById('matiere');
            var classeSelect = document.getElementById('classe');

            // Ajouter des gestionnaires d'événements pour détecter les changements de sélection
            matiereSelect.addEventListener('change', function () {
                filterForm.submit();
            });
            classeSelect.addEventListener('change', function () {
                filterForm.submit();
            });
        </script>

        <!-- Ajouter les notes -->
        <?php if ($id_matiere && $id_classe) { ?>
            <?php
            // Récupérer le nom de la matière
            $stmt = $pdo->prepare("SELECT * FROM matiere WHERE id_matiere = :id_matiere");
            $stmt->execute(['id_matiere' => $id_matiere]);
            $matiere = $stmt->fetch();

            if ($matiere) {
                $nom_matiere = $matiere['nom_matiere'];
                ?>
                </br>
                <h2>📚
                    <?php echo htmlspecialchars($nom_matiere); ?>
                </h2>
                <form method="post">
                    <div class="form-group">
                        <label for="date">📅 Date :</label>
                        <input type="date" class="form-control" name="date" id="date" value="<?php echo date('Y-m-d'); ?>"
                            required><br>
                    </div>
                    <div class="form-group">
                        <label for="intitule">📝 Intitulé :</label>
                        <input type="text" class="form-control" name="intitule" id="intitule" required><br>
                    </div>
                    <div class="infos">
                        Si vous entrez une note à un étudiant, il faut remplir toutes les informations suivantes que cette
                        dernière soit enregistrée.
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Note</th>
                                <th>Coefficient</th>
                                <th>Commentaire</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $pdo->prepare("SELECT * FROM etudiant WHERE id_classe = :id_classe");
                            $stmt->execute(['id_classe' => $id_classe]);
                            while ($row = $stmt->fetch()) { ?>
                                <tr>
                                    <td>
                                        <?php echo htmlspecialchars($row['nom_etudiant']); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($row['prenom_etudiant']); ?>
                                    </td>
                                    <td><input type="number" class="form-control"
                                            name="notes[<?php echo htmlspecialchars($row['id_etudiant']); ?>][note]" min="0"
                                            max="20"></td>
                                    <td><input type="number" class="form-control"
                                            name="notes[<?php echo htmlspecialchars($row['id_etudiant']); ?>][coefficient]"
                                            value="1" step="0.01"></td>
                                    <td><input type="text" class="form-control"
                                            name="notes[<?php echo htmlspecialchars($row['id_etudiant']); ?>][commentaire]"></td>
                                    <td>
                                        <input type="hidden"
                                            name="notes[<?php echo htmlspecialchars($row['id_etudiant']); ?>][id_etudiant]"
                                            value="<?php echo htmlspecialchars($row['id_etudiant']); ?>">
                                        <input type="hidden"
                                            name="notes[<?php echo htmlspecialchars($row['id_etudiant']); ?>][id_matiere]"
                                            value="<?php echo htmlspecialchars($matiere['id_matiere']); ?>">
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary" name="submit">Ajouter les notes</button>
                </form>

                <!-- Afficher la liste des notes -->
                </br>
                <h2>⭐️ Liste des notes</h2>
                <div class="infos">
                    Vous pouvez survoler les notes pour afficher l'ensemble des informations associées, les notes sont affichées
                    des plus récentes aux plus anciennes.
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> Étudiant </th>
                            <?php for ($i = $max_notes; $i >= 1; $i--) { ?>
                                <th>Note
                                    <?php echo $i; ?>
                                </th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $row_index = 0;
                        foreach ($etudiants as $etudiant) {
                            $row_class = ($row_index % 2 == 0) ? 'row-white' : 'row-light-grey';
                            ?>
                            <tr class="<?php echo $row_class; ?>">
                                <td><i>
                                        <?php echo htmlspecialchars($etudiant['nom_etudiant']) . ' ' . htmlspecialchars($etudiant['prenom_etudiant']); ?>
                                    </i>
                                    <?php if (isset($moyennes[$etudiant['id_etudiant']])) { ?>
                                        (Moyenne :
                                        <?php echo htmlspecialchars($moyennes[$etudiant['id_etudiant']]); ?>)
                                    <?php } ?>
                                </td>
                                <?php for ($i = 0; $i < $max_notes; $i++) { ?>
                                    <td>
                                        <?php if (isset($notes[$etudiant['id_etudiant']][$i])) { ?>

<!-- L'indentation est comme ceci car cela définit les espaces des informations affichées lors du survol de la souris -->
                                            <span title="Intitulé : <?php echo htmlspecialchars($notes[$etudiant['id_etudiant']][$i]['intitule']); ?> 
Date : <?php echo htmlspecialchars($notes[$etudiant['id_etudiant']][$i]['date']); ?>

Coefficient : <?php echo htmlspecialchars($notes[$etudiant['id_etudiant']][$i]['coefficient']); ?>

Commentaire : <?php echo htmlspecialchars($notes[$etudiant['id_etudiant']][$i]['commentaire']); ?>">

                                                <?php echo htmlspecialchars($notes[$etudiant['id_etudiant']][$i]['note']); ?>
                                            </span>
                                            <!-- Ajouter un bouton de suppression -->
                                            <form method="post" style="display: inline;">
                                                <input type="hidden" name="delete_note_id"
                                                    value="<?php echo htmlspecialchars($notes[$etudiant['id_etudiant']][$i]['id_note']); ?>">
                                                <button type="submit" class="btn btn-link text-muted custom-cross-btn"
                                                    name="delete_note">❌</button>
                                            </form>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                            </tr>
                            <?php
                            $row_index++;
                        }
                        ?>
                    </tbody>

                </table>

            <?php } ?>
        <?php } ?>

    </div>

</body>

</html>
