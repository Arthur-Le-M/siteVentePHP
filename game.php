<?php 
$id = $_GET['id'];

$conn = new PDO('mysql:host=localhost;dbname=bd_happygame;charset=utf8','root','');

$req =  "SELECT * FROM game WHERE id = :id";
$req = $conn->prepare($req);
$req->execute(['id'=>$id]);
$res = $req->fetch();

$nom = $res['nom'];
$prix = $res['prix'];
$url_images = $res['url_images'];
$console = $res['console'];
$description = $res['description'];

$information = [
    'nom' => $nom,
    'prix' => $prix,
    'url_images' => $url_images,
    'console' => $console,
    'description' => $description
  ];
  
  $json = json_encode($information);
  print($json)

?>