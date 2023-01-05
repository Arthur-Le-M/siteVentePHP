<?php
require '../config.php';

//Vérification des droits
if($_SESSION['admin'] == false){
    header("location: ../index.php");
}

//Récupération des paramètres
$nom = $_GET['nom'];
$desc = $_GET['desc'];
$lienImage = $_GET['lienImage'];
$prix = $_GET['prix'];
$listeGenre = json_decode($_GET['listeGenre'], true);

//Ajout du Jeu dans la BD Jeu
$req = 'INSERT INTO game (nom, prix, url_images, description) VALUES ("'.$nom.'", "'.$prix.'", "'.$lienImage.'", "'.$desc.'")';
$req = $conn->prepare($req);
$req->execute();

//Récupération de l'id du jeu qui viens d'être ajouter
$req = 'SELECT id FROM game WHERE nom="'.$nom.'" AND prix='.$prix.' AND url_images="'.$lienImage.'" AND description="'.$desc.'"';
$req = $conn->prepare($req);
$req->execute();
$res = $req->fetch();

$id = $res['id'];

//Ajout des association de genre dans la table genregameassociation

for($i=0; $i<count($listeGenre); $i++){
    $idGenre = $listeGenre[$i];
    $req = "INSERT INTO genregameassociation (idJeux, idGenre) VALUE ($id, $idGenre)";
    $req = $conn->prepare($req);
    $req->execute();
}

?>