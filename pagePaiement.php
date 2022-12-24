<?php
//Démarrage de la session
session_start();

//Connexion à la base de données
$conn = new PDO('mysql:host=localhost;dbname=bd_happygame;charset=utf8','root','');

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- En-tête de la page -->
        <meta charset="utf-8" />
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<link rel="stylesheet" href="style.css" />
        <title>Site de vente de jeux</title>
    </head>

    <body>
        <!-- Corps de la page -->
        <!-- Head -->
        <header>
            <section id="logoContainer">
                <h2 id="titreLogo">HAPPYGAME</h2>
            </section>
            <nav id="barreDeNav">
                <ul>
                    <li><a href="index.php" class="lienNavBar">HOME</a></li>
                    <li><a href="#" class="lienNavBar">SEARCH</a></li>
                    <li><a href="#" class="lienNavBar">ABOUT</a></li>
                </ul>
            </nav>
            <a id='panierEnHaut' href="cart.php"><img src="images/panier.svg" id="iconPanier" alt="iconPanier">
                <div class="nbArticleContainer">0</div>
                <?php
                /*
                if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
                    print('<div class="nbArticleContainer">'.count($_SESSION['cart']).'</div>');
                }
                */
                ?>
            </a>
        </header>
        <!-- Main -->
        <main>
            <?php
                if(!isset($_GET["resPaiement"]) || $_GET["resPaiement"] == "error"){
                    if(isset($_GET["resPaiement"]) && $_GET["resPaiement"] == "error"){
                        print("<p class='erreur'> Les informations de la cartes ne sont pas valide</p>");
                    }
            ?>
            <form id="formulairePaiement" method="POST" action="traitementPaiement.php">
                <h3 id="titreFormulaire">💳Paiement par carte bancaire💳</h3>
                <label for="numCB" class="labelForm">Numéro carte bancaire</label>
                <input type="text" class="inputForm" name="numCB" placeholder="numéro carte bancaire" maxlength="16" pattern="[0-9]*">
                <label for="expiration" class="labelForm">Date d'expiration</label>
                <div class="expirationContainer" name="expiration">
                    <select name="expirationMois" class="selectExpiration">
                        <option value="1">01</option>
                        <option value="2">02</option>
                        <option value="2">03</option>
                        <option value="2">04</option>
                        <option value="2">05</option>
                        <option value="2">06</option>
                        <option value="2">07</option>
                        <option value="2">08</option>
                        <option value="2">09</option>
                        <option value="2">10</option>
                        <option value="2">11</option>
                        <option value="12">12</option>
                    </select>
                    <select name="expirationAnnee" class="selectExpiration">
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                    </select>
                </div>
                <label for="CCV" class="labelForm">CCV</label>
                <input type="text" class="inputForm" name="CCV" placeholder="CCV" maxlength="3" pattern="[0-9]*">
                <input type="submit" value="Payer" class="boutonForm">
            </form>
            <?php
            }
            else{
                if($_GET['resPaiement'] == "success"){
                    print(" <article class='resPaiement'>
                                <h3>Votre paiement à été validé</h3>
                                <a href='index.php'>Retour à la page d'accueil</a>
                            </article>");
                }
            }
            ?>
        </main>
        <script src="JS/app.js"></script>
    </body>
</html>