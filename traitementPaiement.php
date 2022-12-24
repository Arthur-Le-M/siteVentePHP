<?php
session_start();
$numCarte = $_POST["numCB"];
$moisExpiration = $_POST["expirationMois"];
$anneeExpiration = $_POST["expirationAnnee"];
$ccv = $_POST["CCV"];

function verifNumCarte($numero){
    if(strlen($numero) > 16){
        return false;
    }
    if(substr($numero, 0, 2) != substr($numero, -2, 2)){
        return false;
    }
    return true;
}

function verifExpiration($mois, $annee){
    $dateActuelle = new DateTime();
    $dateExpiration = new DateTime($annee.'-'.$mois.'-01');
    if($dateExpiration > $dateActuelle->modify("+3 months")){
        return true;
    }
}

if(verifNumCarte($numCarte) && verifExpiration($moisExpiration , $anneeExpiration)){
    unset($_SESSION['cart']);
    header("location: pagePaiement.php?resPaiement=success");
}
else{
    header("location: pagePaiement.php?resPaiement=error");
}

?>