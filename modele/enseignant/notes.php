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
    // Sauvegarder les choix d'affichage dans des variables de session après chaque changement de pages, comme à chaque insertion/suppresion de notes
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
    $date = $_POST['date'];
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
            $sql = "INSERT INTO note (note, coefficient, commentaire, intitule, id_etudiant, id_matiere, id_enseignant, date) VALUES (:note_value, :coefficient, :commentaire, :intitule, :id_etudiant, :id_matiere, :id_enseignant, :date)";
            if ($pdo->prepare($sql)->execute(['note_value' => $note_value, 'coefficient' => $coefficient, 'commentaire' => $commentaire, 'intitule' => $intitule, 'id_etudiant' => $id_etudiant, 'id_matiere' => $id_matiere, 'id_enseignant' => $id_enseignant, 'date' => $date])) {
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

// Récupérer les étudiants de la classe
$stmt = $pdo->prepare("SELECT * FROM etudiant WHERE id_classe = :id_classe");
$stmt->execute(['id_classe' => $id_classe]);
$etudiants = $stmt->fetchAll();

// Récupérer les notes pour chaque étudiant
$notes = [];
$moyennes = [];
foreach ($etudiants as $etudiant) {
    $stmt = $pdo->prepare("SELECT * FROM note WHERE id_enseignant = :id_enseignant AND id_matiere = :id_matiere AND id_etudiant = :id_etudiant ORDER BY date DESC, id_note DESC");
    $stmt->execute(['id_enseignant' => $id_enseignant, 'id_matiere' => $id_matiere, 'id_etudiant' => $etudiant['id_etudiant']]);
    $notes[$etudiant['id_etudiant']] = $stmt->fetchAll();

    // Calculer la moyenne des notes pour cet étudiant
    $total_notes = 0;
    $total_coefficients = 0;
    foreach ($notes[$etudiant['id_etudiant']] as $note) {
        $total_notes += $note['note'] * $note['coefficient'];
        $total_coefficients += $note['coefficient'];
    }
    if ($total_coefficients > 0) {
        $moyennes[$etudiant['id_etudiant']] = round($total_notes / $total_coefficients, 2);
    } else {
        $moyennes[$etudiant['id_etudiant']] = null;
    }

    // Mettre à jour la moyenne des notes pour cet étudiant dans la base de données
    $stmt = $pdo->prepare("UPDATE etudiant SET moyenne = :moyenne WHERE id_etudiant = :id_etudiant");
    $stmt->execute(['moyenne' => $moyennes[$etudiant['id_etudiant']], 'id_etudiant' => $etudiant['id_etudiant']]);
}

// Calculer le nombre maximum de notes pour un étudiant
$max_notes = 0;
foreach ($notes as $etudiant_notes) {
    if (count($etudiant_notes) > $max_notes) {
        $max_notes = count($etudiant_notes);
    }
}
?>