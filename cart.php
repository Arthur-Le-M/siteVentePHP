<?php
require 'config.php';
require 'templates/header.php';
?>

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
                                <img class="imagesArticlePanier" src="api/traitementImage.php?url='.$res['url_images'].'&width=200&height=200" alt="imageDuJeu">
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
                    <a class="buttonCheckout" href="pagePaiement.php">Procéder au paiement</a>
                    <a class="buttonContinue" href="index.php">Continuer le shopping</a>
                </article>
            </section>
        </main>
<?php
require 'templates/footer.php';
?>