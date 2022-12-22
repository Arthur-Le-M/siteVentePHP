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
            <?php 
                if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
                    print('<div class="nbArticleContainer">'.count($_SESSION['cart']).'</div>');
                }
                ?>
            </a>
        </header>
        <main>
            <section class="cart">
                <h3 class="titreArticleContainer">🛒 PANIER 🛒</h3>
                <article class="listArticlePanier">
                    
                    <?php
                    
                    $prixGlobal = 0;
                    $nbArticle = 0;
                    if(isset($_SESSION['cart'])){
                        for($i = 0; $i<count($_SESSION['cart']);$i++){
                            $id = $_SESSION['cart'][$i];
                            $req =  "SELECT * FROM game WHERE id = :id";
                            $req = $conn->prepare($req);
                            $req->execute(['id'=>$id]);
                            $res = $req->fetch();
                            print('<div class="articlePanier" name="'.$id.'">
                                <img class="imagesArticlePanier" src="traitementImage.php?url='.$res['url_images'].'&width=200&height=200" alt="imageDuJeu">
                                <h4 class="titreArticlePanier">'.$res['nom'].'</h4>
                                <p class="prixArticlePanier">'.$res['prix'].'€</p>
                                <a class="supressionPanier" href="removeToCart.php?id='.$id.'">Supprimer</a>
                                </div>');
                            $prixGlobal += $res['prix'];
                            $nbArticle += 1;
                        }
                    }
                    
                    ?>
                    
                </article>
                <article class="recapCart">
                    <?php 
                        print('<p class="textRecap">Nombre articles : '.$nbArticle.'</p>');
                        print('<p class="textRecap">Total : '.$prixGlobal.'€</p>')
                        ?>
                </article>
                <article class="checkout">
                    <a class="buttonCheckout" href="#">Procéder au paiement</a>
                    <a class="buttonContinue" href="index.php">Continuer le shopping</a>
                </article>
            </section>
        </main>
    </body>
</html>