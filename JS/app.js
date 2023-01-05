
//Ajouter au panier
boutonAjouterAuPanier = document.querySelectorAll(".boutonAddToCart")
notification = document.querySelector(".notif");
var nombreNotif = 0

for(var i=0; i<boutonAjouterAuPanier.length; i++){
    boutonAjouterAuPanier[i].addEventListener('click', e=>{
        id = e.target.getAttribute('name');
        url = "api/addToCart.php?id=" + id
        //Requête ajax
        xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.send();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
              //Réussite
              afficherTaillePanier()
              var notifAddCart = document.createElement('div')
              notifAddCart.className = "notifvisible"
              notifAddCart.innerHTML = notification.innerHTML
              notifAddCart.style.bottom = ((10 + 45) * nombreNotif).toString() + "px";
              notifAddCart.children[0].innerHTML = e.target.parentNode.parentNode.children[1].innerHTML + " à été ajouté au panier"
              document.body.appendChild(notifAddCart);
              nombreNotif += 1;
              setTimeout(function() {
                notifAddCart.remove()
                nombreNotif -= 1
              }, 3000);
            } else {
              //Echec
            }
          };
    })
}


function afficherTaillePanier(){
  taillePanier = document.querySelector(".nbArticleContainer")
  //Appel du script qui renvoie la liste du panier sous forme JSON
  const xhr = new XMLHttpRequest();
  xhr.open('GET', 'api/listeCarte.php');
  xhr.send();
  xhr.addEventListener('load', function() {
    const cart = JSON.parse(xhr.response);
    //Affchage de la taille du tableau
    taillePanier.innerHTML = cart.length
  });
}

afficherTaillePanier()