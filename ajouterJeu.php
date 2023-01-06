<?php
require 'config.php';
require 'templates/header.php';

if($_SESSION['admin'] == false){
    header("location: index.php");
}
?>
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

                <a class="boutonFormAjouterJeu">Ajouter</a>
            </form>
        </main>
<?php
require 'templates/footer.php';
?>