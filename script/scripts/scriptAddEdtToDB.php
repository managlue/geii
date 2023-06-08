<?php

$host = 'localhost';
$dbname = 'geii';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
    die();
}

$file = '../data/edt.txt';

if (file_exists($file) && $fichier = fopen($file, 'r')) {
    $l = [];

    while (($ligne = fgets($fichier)) !== false) {
        $ligne = trim($ligne);

        if (!empty($ligne)) $mots = explode(' ', $ligne);
        $l[] = [
            'jour' => $mots[0],
            'heure_debut' => $mots[1],
            'heure_fin' => $mots[2],
            'salle' => $mots[3],
            'id_enseignant' => $mots[4],
            'id_matiere' => $mots[5],
            'id_classe' => $mots[6],
        ];
    }

    fclose($fichier);
}

$sql = "INSERT INTO emploi_du_temps (jour, heure_debut, heure_fin, salle, id_enseignant, id_matiere, id_classe)
        VALUES ";

for ($cpt = 0; $cpt < count($l); $cpt++) {
    $sql .=  "('" . $l[$cpt]['jour'] .
            "','" . $l[$cpt]['heure_debut'] .
            "','" . $l[$cpt]['heure_fin'] .
            "','" . $l[$cpt]['salle'] .
            "',"  . $l[$cpt]['id_enseignant'] .
             ","  . $l[$cpt]['id_matiere'] .
             ","  . $l[$cpt]['id_classe'] . ")";

    if ($cpt+1 == count($l)) $sql .= ';';
    else  $sql .= ',';
}

$stmt = $pdo->prepare($sql);
$stmt->execute();
