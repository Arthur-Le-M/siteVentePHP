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
        <!-- Main -->
        <main>
            
            <section class="articleContainer">
                <h3 class="titreArticleContainer">🔥 ALL 🔥</h3>
                <article class="listArticle">
                <?php
                //Requête sur la table Jeux
                $req =  "SELECT * FROM game";
                $req = $conn->prepare($req);
                $req->execute();
                $res = $req->fetchAll();
                
                //Requête sur la table genre
                $req =  "SELECT * FROM genres";
                $req = $conn->prepare($req);
                $req->execute();
                $resGenre = $req->fetchAll();
                //Parcours de la table Jeux
                for($i=0;$i<count($res);$i++){
                    //Récupération des genres du jeu
                    $req =  "SELECT * FROM genregameassociation WHERE idJeux = :idJeux";
                    $req = $conn->prepare($req);
                    $req->execute(['idJeux'=>$res[$i]['id']]);
                    $resGenreJeux = $req->fetchAll();
                    print("<div class='article'>
                    <img class='articleImg' src='".$res[$i]['url_images']."' alt='imageArticle'>
                    <h4 class='articleTitre'>".$res[$i]['nom']."</h4>
                    <div class='articleListGenre'>");
                        for($y=0;$y<count($resGenreJeux);$y++){
                            print("<p class='genre'>".$resGenre[$resGenreJeux[$y]['idGenre']-1]['libelle']."</p>");
                        }
                    print("
                    </div>
                    <p class='articlePrix'>".$res[$i]['prix']."€</p>
                    <a class='bouton' href='addToCart.php?id=".$res[$i]['id']."'><div class ='articleButtonAjouterPanier'>AJOUTER AU PANIER</div></a>
                </div>");
                }
                ?>
                </article>
            </section>
        </main>
        <script src="script.js"></script>
    </body>
</html>