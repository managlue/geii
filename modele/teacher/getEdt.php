<?php
// Chemin du dossier contenant les images
$edtPath = '../assets/edt';

// Obtention de la liste des fichiers dans le dossier
$fichiers = scandir($edtPath);

var_dump($fichiers);

// Parcours des fichiers pour trouver la première image
$premiereImage = null;
foreach ($fichiers as $fichier) {
    $cheminFichier = $edtPath . '/' . $fichier;
    // Vérification si le fichier est une image
    if (is_file($cheminFichier) && getimagesize($cheminFichier)) {
        $premiereImage = $fichier;
        break;
    }
}

// Affichage de l'image en HTML
if ($premiereImage) {
    $cheminImage = $edtPath . '/' . $premiereImage;
    echo '<img src="' . $cheminImage . '" alt="Première image">';
} else {
    echo "Aucun emplois du temps n'a été uploadé.";
}
?>
