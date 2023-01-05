<?php
require 'config.php';

if($_SESSION['admin'] == false){
    header("location: index.php");
}
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
            <form id="formulaireAjoutDeJeu">
                <label class="labelForm" for="nomJeu">Nom</label>
                <input type="text" class="inputForm" name="nomJeu" placeholder="Nom du jeu">

                <label class="labelForm" for="descJeu">Description</label>
                <textarea class="textAreaForm" name="descJeu" placeholder="Description du jeu" rows="10" cols="30" style="resize: none;"></textarea>

                <label class="labelForm">Genres</label>
                <div id="selectionGenreAjoutJeu">
                    <?php
                        $req = "SELECT * FROM genres";
                        $req = $conn->prepare($req);
                        $req->execute();
                        $res = $req->fetchAll();
                        for($i=0;$i<count($res);$i++){
                            print('<p class="genreJeuAjoutJeu" name='.$res[$i]["id"].'>'.$res[$i]["libelle"].'</p>');
                        }
                    ?>
                </div>

                <label class="labelForm" for="lienImageJeu">Lien de l'image</label>
                <input class="inputForm" name="lienImageJeu" placeholder="Lien de l'image du jeu">

                <label class="labelForm" for="prixJeu">Prix</label>
                <input class="inputForm" type="number" step="0.01" name="prixJeu" placeholder="Prix du jeu en €">

                <a class="boutonForm">Ajouter</a>
            </form>
        </main>
                

        <script src="JS/app.js"></script>
        <script src="JS/ajoutJeu.js"></script>
        <script src="JS/scriptCarte.js"></script>
    </body>
</html>