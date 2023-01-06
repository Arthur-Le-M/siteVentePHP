<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- En-tête de la page -->
        <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="style.css" />
        <link rel="icon" href="images/logoHappyGames.ico"/>
        <title>HAPPY GAMES</title>
    </head>

    <body>
        <!-- Corps de la page -->
        <!-- Head -->
        <header>
            <section id="logoContainer">
                <a href="index.php"><img class="logo" src="images/logoHappyGames.svg" alt="logo du site"></a>
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
