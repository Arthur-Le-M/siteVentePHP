<?php
//Démarrage de la session
session_start();
//Connexion à la base de données
$conn = new PDO('mysql:host=localhost;dbname=bd_happygame;charset=utf8','root','');
?>