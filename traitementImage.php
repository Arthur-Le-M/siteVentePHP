<?php
$url = $_GET['url'];
// Paramètres de l'image
$width = $_GET["width"];
$height = $_GET["height"];

// Charger l'image originale
$original_image = imagecreatefromstring(file_get_contents($url));

// Créer une image vide pour l'image
$image = imagecreatetruecolor($width, $height);

// Redimensionner l'image originale pour l'image
imagecopyresampled($image, $original_image, 0, 0, 0, 0, $width, $height, imagesx($original_image), imagesy($original_image));

header('Content-Type: image/jpeg');
// Enregistrer l'image
imagejpeg($image);


// Libérer la mémoire utilisée par les images
imagedestroy($original_image);
imagedestroy($image);
?>