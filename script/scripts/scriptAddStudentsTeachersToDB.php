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

$files = [
    'etudiant' => '../data/studentList.txt',
    'enseignant' => '../data/teacherList.txt',
];

foreach ($files as $table => $file) {
    if (file_exists($file) && $fichier = fopen($file, 'r')) {
        $l = [];

        while (($ligne = fgets($fichier)) !== false) {
            $ligne = trim($ligne);

            if (!empty($ligne)) $mots = explode(' ', $ligne);
            $l[] = [
                "nom_$table" => $mots[0],
                "prenom_$table" => $mots[1],
                "login_$table" => $mots[2],
                "pswd_$table" => $mots[3],  // ajouter la fonction de cryptage
                "id_classe" => $mots[4],
            ];
        }

        fclose($fichier);
    }

    $sql = "INSERT INTO $table (nom_$table, prenom_$table, login_$table, pswd_$table, id_classe)
            VALUES ";

    for ($cpt = 0; $cpt < count($l); $cpt++) {
        $sql .= "('" . $l[$cpt]["nom_$table"] .
                "','" . $l[$cpt]["prenom_$table"] .
                "','" . $l[$cpt]["login_$table"] .
                "','" . $l[$cpt]["pswd_$table"] .
                "','" . $l[$cpt]["id_classe"] . "')";

        if ($cpt+1 == count($l)) $sql .= ';';
        else  $sql .= ',';
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}
