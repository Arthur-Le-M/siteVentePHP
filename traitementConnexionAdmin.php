<?php
session_start();

$identifiant = htmlspecialchars($_POST["login"]);
$passwd = htmlspecialchars($_POST["passwd"]);

if($identifiant == "root" && $passwd="root29"){
    $_SESSION["admin"] = true;
    header("location: index.php");
}
else{
    header("location: connexionAdmin.php?err=true");
}
?>