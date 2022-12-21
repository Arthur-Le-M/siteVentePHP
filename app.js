boutonAjouterAuPanier = document.querySelectorAll(".boutonAddToCart")
notification = document.querySelector(".notif");
var nombreNotif = 0

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
              console.log("Fail")
            }
          };
    })
}