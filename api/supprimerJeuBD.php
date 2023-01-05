<?php
require '../config.php';

//Vérification des droits
if($_SESSION['admin'] == false){
    header("location: ../index.php");
}

//Récupération de l'id
$id = $_GET['id'];

//Requête de suppression
$req = "DELETE FROM game WHERE id=$id";
$req = $conn->prepare($req);
$req->execute();

header("location: ../index.php")
?>