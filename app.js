boutonAjouterAuPanier = document.querySelectorAll(".boutonAddToCart")

for(var i=0; i<boutonAjouterAuPanier.length; i++){
    boutonAjouterAuPanier[i].addEventListener('click', e=>{
          id = e.target.getAttribute('name');
          url = "addToCart.php?id=" + id
          console.log(url)
        //Requête ajax
        xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        console.log(url)
        xhr.send();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
              //Réussite
              console.log("Item " + id + " ajouté au panier")
            } else {
              //Echec
              console.log("Fail")
            }
          };
    })
}