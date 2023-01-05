images = document.querySelectorAll('.articleImg');
images.forEach(image => {
    //Quand la souris est dessus
    image.addEventListener('mousemove', function addAnimation(e){
        const percentX = e.offsetX  / image.offsetWidth * 100;
        const percentY = e.offsetY  / image.offsetHeight * 100;
        const rotateX = (percentY - 50) / 50 * 20;
        const rotateY = (percentX - 50) / 50 * 20;
        image.style.transform = `perspective(500px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
    })

    //Quand la souris n'est plus dessus
    image.addEventListener('mouseout', function removeAnimation(){
        image.style.transform = 'none';
    })

    //IMAGE MODALE
    //Quand on clique sur l'image
    image.addEventListener('click', function() {
        const modal = document.querySelector('#modal');
        const modalImage = document.querySelector('#modalImage');
        const modalTitre = document.querySelector('#titreJeuxModal');
        const modalPrix = document.querySelector('#prixJeuModal');
        const modalContainerGenre = document.querySelector("#genreContainerModal");
        var modalDesc = document.querySelector('#descJeuxModal');
        var sectionModal = document.querySelector('#modalDesc');
        modalImage.src = this.src;
        //Récupération des information
        parentImage = this.parentNode
        enfant = parentImage.children
        var id = parentImage.getAttribute('name')
        modalTitre.innerHTML = enfant[1].innerHTML
        modalPrix.innerHTML = enfant[3].innerHTML
        xhr = new XMLHttpRequest();
        xhr.open('GET', 'api/game.php?id=' + id);
        xhr.send();
        xhr.onload = function() {
          if (xhr.status === 200) {
            const jeu = JSON.parse(xhr.response);
            modalDesc.innerHTML = jeu['description']
            for(i=0; i<jeu['libelleGenres'].length; i++){
              let objGenre = document.createElement('p');
              objGenre.classList.add("genreModaux");
              objGenre.innerHTML = jeu['libelleGenres'][i];
              modalContainerGenre.appendChild(objGenre);

            }
          } else {
            console.error('An error occurred:', xhr.status);
          }
        };
        //Bouton
        //Création de l'objet
        let boutonModal = document.createElement('a');
        boutonModal.className = 'boutonModal';
        let div = document.createElement('div');
        div.innerHTML = "AJOUTER AU PANIER";
        div.className = 'articleButtonAjouterPanierModal';
        boutonModal.appendChild(div);
        sectionModal.appendChild(boutonModal);

        boutonModal.addEventListener("click", () => boutonModalClique(id, modalTitre.innerHTML));
        modal.classList.add('visible');
});
    
});

const modalImage = document.querySelector('#modalImage');
modalImage.addEventListener('mousemove', e => {
    const percentX = e.offsetX  / modalImage.offsetWidth * 100;
    const percentY = e.offsetY  / modalImage.offsetHeight * 100;
    const rotateX = (percentY - 50) / 50 * 20;
    const rotateY = (percentX - 50) / 50 * 20;
    modalImage.style.transform = `perspective(500px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
})

//Quand la souris n'est plus dessus
modalImage.addEventListener('mouseout', ()=>{
    modalImage.style.transform = 'none';
})
const modal = document.querySelector('#modal');
var modalContainerGenre = document.querySelector("#genreContainerModal");
modal.addEventListener('click', function(event){
  if (event.target === modal) {
    //Suppression bouton
    var modalButton = document.querySelector('.boutonModal');
    var sectionModal = document.querySelector('#modalDesc');
    sectionModal.removeChild(modalButton);
    modal.classList.remove('visible');
    while (modalContainerGenre.firstChild) {
      modalContainerGenre.removeChild(modalContainerGenre.firstChild);
    }
  }
});

function boutonModalClique(id, titre){
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
    notifAddCart.children[0].innerHTML = titre + " à été ajouté au panier"
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
}