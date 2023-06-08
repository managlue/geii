<!DOCTYPE html>
    <html lang="en">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GEII - Espace Enseignant</title>
        <link rel="stylesheet" type="text/css" href="../../css/Enseignant_CSS/enseignant.css">

       
        <?php
                session_start();
                include '../../modele/connexionBd.php';

                if (!isset($_SESSION['idConnected'])) {
                    header("Location: ../../modele/login.php");
                }

                $id_enseignant = $_SESSION['idConnected'];

                // Récupérer les matières
                $stmt = $pdo->prepare("SELECT matiere.* FROM matiere JOIN enseignant_matiere ON matiere.id_matiere = enseignant_matiere.id_matiere WHERE enseignant_matiere.id_enseignant = :id_enseignant");
                $stmt->execute(['id_enseignant' => $id_enseignant]);
                $matieres = $stmt->fetchAll();

                // Récupérer les classes
                $stmt = $pdo->prepare("SELECT * FROM classe");
                $stmt->execute();
                $classes = $stmt->fetchAll();

                // Récupérer la matière et la classe sélectionnées
                if (isset($_GET['matiere']) && isset($_GET['classe'])) {
                    $id_matiere = $_GET['matiere'];
                    $id_classe = $_GET['classe'];
                    // Sauvegarder les choix dans des variables de session
                    $_SESSION['id_matiere'] = $id_matiere;
                    $_SESSION['id_classe'] = $id_classe;
                } else {
                    // Récupérer les choix à partir des variables de session
                    $id_matiere = isset($_SESSION['id_matiere']) ? $_SESSION['id_matiere'] : null;
                    $id_classe = isset($_SESSION['id_classe']) ? $_SESSION['id_classe'] : null;
                }

                if (isset($_POST['submit'])) {
                    $valid = true; // Variable pour vérifier la validation des champs
                    $intitule = $_POST['intitule'];
                    foreach ($_POST['notes'] as $note) {
                        $note_value = $note['note'];
                        $coefficient = $note['coefficient'];
                        $commentaire = $note['commentaire'];
                        $id_etudiant = $note['id_etudiant'];
                        $id_matiere = $note['id_matiere'];
                
                        // Vérifier si les champs sont vides
                        if (empty($note_value) || empty($coefficient) || empty($commentaire)) {
                            $valid = false;
                        } else {
                            $sql = "INSERT INTO note (note, coefficient, commentaire, intitule, id_etudiant, id_matiere, id_enseignant) VALUES (:note_value, :coefficient, :commentaire, :intitule, :id_etudiant, :id_matiere, :id_enseignant)";
                
                            if ($pdo->prepare($sql)->execute(['note_value' => $note_value, 'coefficient' => $coefficient, 'commentaire' => $commentaire, 'intitule' => $intitule, 'id_etudiant' => $id_etudiant, 'id_matiere' => $id_matiere, 'id_enseignant' => $id_enseignant])) {
                                // Note ajoutée avec succès
                            } else {
                                echo "Erreur: " . print_r($pdo->errorInfo(), true);
                            }
                        }
                    }
                
                    if ($valid) {
                        header("Location: confirmation.php");
                        exit;
                    } else {
                        /*echo "Veuillez remplir tous les champs pour valider les notes.";*/
                    }
                }
                


                    if (isset($_POST['delete_note'])) {
                        $delete_note_id = $_POST['delete_note_id'];
                        $stmt = $pdo->prepare("DELETE FROM note WHERE id_note = :delete_note_id");
                        if ($stmt->execute(['delete_note_id' => $delete_note_id])) {
                            header("Location: confirmation_suppression.php");
                            exit;
                        } else {
                            echo "Erreur: " . print_r($pdo->errorInfo(), true);
                        }
                    }
                    ?>



                    <!-- Afficher les options de sélection pour la matière et la classe -->
                    <form method="get" id="filter-form">
                        <label for="matiere">Matière:</label>
                        <select name="matiere" id="matiere">
                            <?php foreach ($matieres as $matiere) { ?>
                                <option value="<?php echo htmlspecialchars($matiere['id_matiere']); ?>"<?php if ($matiere['id_matiere'] == $id_matiere) { echo ' selected'; } ?>><?php echo htmlspecialchars($matiere['nom_matiere']); ?></option>
                            <?php } ?>
                        </select>
                        <label for="classe">Classe:</label>
                        <select name="classe" id="classe">
                            <?php foreach ($classes as $classe) { ?>
                                <option value="<?php echo htmlspecialchars($classe['id_classe']); ?>"<?php if ($classe['id_classe'] == $id_classe) { echo ' selected'; } ?>><?php echo htmlspecialchars($classe['nom_classe']); ?></option>
                            <?php } ?>
                        </select>
                    </form>

                    <script>
                        // Sélectionner les éléments du formulaire
                        var filterForm = document.getElementById('filter-form');
                        var matiereSelect = document.getElementById('matiere');
                        var classeSelect = document.getElementById('classe');

                        // Ajouter des gestionnaires d'événements pour détecter les changements de sélection
                        matiereSelect.addEventListener('change', function() {
                            filterForm.submit();
                        });
                        classeSelect.addEventListener('change', function() {
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
                            <h2>Matière: <?php echo htmlspecialchars($nom_matiere); ?></h2>
                            <form method="post">
                                <label for="intitule">Intitulé:</label>
                                <input type="text" name="intitule" id="intitule" required><br>
                                <table>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Note</th>
                                        <th>Coefficient</th>
                                        <th>Commentaire</th>
                                    </tr>
                                    <?php
                                    $stmt = $pdo->prepare("SELECT * FROM etudiant WHERE id_classe = :id_classe");
                                    $stmt->execute(['id_classe' => $id_classe]);
                                    while ($row = $stmt->fetch()) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['nom_etudiant']); ?></td>
                                            <td><?php echo htmlspecialchars($row['prenom_etudiant']); ?></td>
                                            <td><input type="text" name="notes[<?php echo htmlspecialchars($row['id_etudiant']); ?>][note]"></td>
                                            <td><input type="text" name="notes[<?php echo htmlspecialchars($row['id_etudiant']); ?>][coefficient]" value="1"></td>
                                            <td><input type="text" name="notes[<?php echo htmlspecialchars($row['id_etudiant']); ?>][commentaire]"></td>
                                            <td>
                                                <input type="hidden" name="notes[<?php echo htmlspecialchars($row['id_etudiant']); ?>][id_etudiant]" value="<?php echo htmlspecialchars($row['id_etudiant']); ?>">
                                                <input type="hidden" name="notes[<?php echo htmlspecialchars($row['id_etudiant']); ?>][id_matiere]" value="<?php echo htmlspecialchars($matiere['id_matiere']); ?>">
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                                <input type="submit" name="submit" value="Ajouter les notes">
                            </form>



                    <!-- Afficher la liste des notes -->
                    <h2>Liste des notes</h2>
                    <?php
                    // Récupérer les étudiants de la classe
                    $stmt = $pdo->prepare("SELECT * FROM etudiant WHERE id_classe = :id_classe ORDER BY nom_etudiant, prenom_etudiant");
                    $stmt->execute(['id_classe' => $id_classe]);
                    $etudiants = $stmt->fetchAll();

                    // Récupérer les notes pour chaque étudiant
                    $notes = [];
                    foreach ($etudiants as $etudiant) {
                        $stmt = $pdo->prepare("SELECT * FROM note WHERE id_enseignant = :id_enseignant AND id_matiere = :id_matiere AND id_etudiant = :id_etudiant ORDER BY id_note DESC");
                        $stmt->execute(['id_enseignant' => $id_enseignant, 'id_matiere' => $id_matiere, 'id_etudiant' => $etudiant['id_etudiant']]);
                        $notes[$etudiant['id_etudiant']] = $stmt->fetchAll();
                    }

                    // Calculer le nombre maximum de notes pour un étudiant
                    $max_notes = 0;
                    foreach ($notes as $etudiant_notes) {
                        if (count($etudiant_notes) > $max_notes) {
                            $max_notes = count($etudiant_notes);
                        }
                    }
                    ?>
                <table>
                    <tr>
                        <th>N° Notes</th>
                        <?php foreach ($etudiants as $etudiant) { ?>
                            <th><?php echo htmlspecialchars($etudiant['prenom_etudiant']) . ' ' . htmlspecialchars($etudiant['nom_etudiant']); ?></th>
                        <?php } ?>
                    </tr>
                    <?php for ($i = 0; $i < $max_notes; $i++) { ?>
                        <tr>
                            <td>Note <?php echo ($i + 1); ?></td>
                            <?php foreach ($etudiants as $etudiant) { ?>
                                <td>
                                    <?php if (isset($notes[$etudiant['id_etudiant']][$i])) { ?>
                                        <span title="Intitulé : <?php echo htmlspecialchars($notes[$etudiant['id_etudiant']][$i]['intitule']); ?> 
                        Coefficient : <?php echo htmlspecialchars($notes[$etudiant['id_etudiant']][$i]['coefficient']); ?> 
                        Commentaire : <?php echo htmlspecialchars($notes[$etudiant['id_etudiant']][$i]['commentaire']); ?>"><?php echo htmlspecialchars($notes[$etudiant['id_etudiant']][$i]['note']); ?></span><br>
                                        <!-- Ajouter un bouton de suppression -->
                                        <form method="post">
                                            <input type="hidden" name="delete_note_id" value="<?php echo htmlspecialchars($notes[$etudiant['id_etudiant']][$i]['id_note']); ?>">
                                            <input type="submit" name="delete_note" value="❌">
                                        </form>
                                    <?php } ?>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
    <?php } ?>
</body>
</html>