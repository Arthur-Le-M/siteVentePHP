//Ajout jeu
//Gestion de la séléction des genres
var listeGenreSelect = []
elementGenre = document.querySelectorAll(".genreJeuAjoutJeu");
for(var i = 0; i<elementGenre.length;i++){
  elementGenre[i].addEventListener('click', e =>{
    if(e.target.className == "genreJeuAjoutJeu"){
      listeGenreSelect.push(e.target.getAttribute('name'))
      e.target.className = "genreJeuAjoutJeu-select"
    }
    else{
      listeGenreSelect.splice(listeGenreSelect.indexOf(e.target.getAttribute('name')), 1);
      e.target.className = "genreJeuAjoutJeu"
    }
    console.log(listeGenreSelect)
  })
}

//Bouton Ajouter
boutonAjouterJeu = document.querySelector(".boutonForm");

boutonAjouterJeu.addEventListener('click', ()=>{
    nom = boutonAjouterJeu.parentNode.children[1].value;
    desc = boutonAjouterJeu.parentNode.children[3].value;
    lienImage = boutonAjouterJeu.parentNode.children[7].value;
    prix = boutonAjouterJeu.parentNode.children[9].value;
    listeGenre = JSON.stringify(listeGenreSelect);

    url = "api/ajouterJeuBD.php?nom=" + nom + "&desc=" + desc + "&lienImage=" + lienImage + "&prix=" + prix + "&listeGenre=" + listeGenre
    console.log(url)
    const xhr = new XMLHttpRequest();
    xhr.open('GET', url);
    xhr.send();
    xhr.onload = function() {
      if (xhr.status === 200){
        //Le jeu est ajouté
        console.log("Jeu ajouté avec succès")
      }
    }
})