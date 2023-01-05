<?php
require 'config.php';
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
            <form id="formConnexionAdmin" action="traitementConnexionAdmin.php" method="POST">
                <label class="labelForm" for="login">Identifiant</label>
                <input type="text" class="inputForm" name="login" placeholder="Identifiant">
                <label class="labelForm" for="passwd">Mot de passe</label>
                <input type="password" class="inputForm" name="passwd" placeholder="Mot de passe">
                <input class="boutonForm" type="submit" value="Connexion">
            </form>
        </main>
        <script src="JS/app.js"></script>
    </body>
</html>