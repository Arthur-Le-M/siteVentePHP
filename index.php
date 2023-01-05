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
            <?php 
            if(isset($_SESSION["admin"]) && $_SESSION["admin"] == true){
                        print('<section id="sectionAdmin">
                        <h2 id="titreSectionAdmin">👑 Mode administrateur activé 👑</h2>
                        <a class="boutonAdmin" href="ajouterJeu.php">➕ Ajouter un jeu</a>
                        <a class="boutonAdmin" href="deconnexionAdmin.php">🚪 Déconnexion</a>
                    </section>');
                    }?>
        <div id="modal">
            <div id="modalDesc">
                <h3 id="titreJeuxModal">Titre jeu</h3>
                <p id="descJeuxModal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus nisi vel, iure ipsam iste, suscipit exercitationem enim fuga autem, quo porro molestias dolores dolor vero minima quae cum? Dolores, enim?</p>
                <div id="genreContainerModal">
                </div>
                <p id="prixJeuModal">10€</p>
                
            </div>
            <img src="" id="modalImage">
        </div>
        <div class="notif">
            <h5 class="titreNotif">Hello World ajouté au panier</h5>
        </div>
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
                    print("<div class='article' name='".$res[$i]['id']."'>
                    <img class='articleImg' src='api/traitementImage.php?url=".$res[$i]['url_images']."&width=500&height=500' alt='imageArticle'>
                    <h4 class='articleTitre'>".$res[$i]['nom']."</h4>
                    <div class='articleListGenre'>");
                        for($y=0;$y<count($resGenreJeux);$y++){
                            print("<p class='genre'>".$resGenre[$resGenreJeux[$y]['idGenre']-1]['libelle']."</p>");
                        }
                    print("
                    </div>
                    <p class='articlePrix'>".$res[$i]['prix']."€</p>
                    <a class='boutonAddToCart'><div class ='articleButtonAjouterPanier' name=".$res[$i]['id']." >AJOUTER AU PANIER</div></a>");
                    if(isset($_SESSION["admin"]) && $_SESSION["admin"] == true){
                        print("<a class='boutonSupprItem' href='api/supprimerJeuBD.php?id=".$res[$i]['id']."'> Supprimer </a>");
                    }
                    print("</div>");
                
                }
                ?>
                </article>
            </section>
        </main>
        <footer>
            <article id="logoFooterContainer">
                <h2>Happy Game</h2>
            </article>
            <article id="buttonFooterContainer">
                <a class="boutonFooter" href="connexionAdmin.php">Administrateur</a>
            </article>
        </footer>

        <script src="JS/app.js"></script>
        <script src="JS/scriptCarte.js"></script>
    </body>
</html>