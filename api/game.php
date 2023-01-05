<?php 
$id = $_GET['id'];

require "../config.php";

$req =  "SELECT * FROM game WHERE id = :id";
$req = $conn->prepare($req);
$req->execute(['id'=>$id]);
$res = $req->fetch();

$nom = $res['nom'];
$prix = $res['prix'];
$url_images = $res['url_images'];
$console = $res['console'];
$description = $res['description'];

$req =  "SELECT libelle FROM genres JOIN genregameassociation ON genres.id = genregameassociation.idGenre WHERE idJeux = :id";
$req = $conn->prepare($req);
$req->execute(['id'=>$id]);
$res = $req->fetchAll();

$listeGenre = [];
foreach ($res as $row) {
  $listeGenre[] = $row['libelle'];
}

$information = [
    'nom' => $nom,
    'prix' => $prix,
    'url_images' => $url_images,
    'console' => $console,
    'description' => $description,
    'libelleGenres' => $listeGenre
  ];
  
  $json = json_encode($information);
  print($json)

?>