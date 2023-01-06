//Ajout jeu
//Gestion de la séléction des genres
var listeGenreSelect = []
var form = document.querySelector("#formulaireAjoutDeJeu")
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
boutonAjouterJeu = document.querySelector(".boutonFormAjouterJeu");

boutonAjouterJeu.addEventListener('click', ()=>{
    nom = boutonAjouterJeu.parentNode.children[1].value;
    desc = boutonAjouterJeu.parentNode.children[3].value;
    lienImage = boutonAjouterJeu.parentNode.children[7].value;
    prix = boutonAjouterJeu.parentNode.children[9].value;
    listeGenre = JSON.stringify(listeGenreSelect);

    if(nom=="" || desc=="" || lienImage=="" || prix==""){
      ajouterMessage("Veuillez remplir tous les champs", form, true)
    }
    else if(listeGenre == "[]"){
      ajouterMessage("Veuillez selectionner au moins un genre", form, true)
    }
    else{
      url = "api/ajouterJeuBD.php?nom=" + nom + "&desc=" + desc + "&lienImage=" + lienImage + "&prix=" + prix + "&listeGenre=" + listeGenre
      console.log(url)
      const xhr = new XMLHttpRequest();
      xhr.open('GET', url);
      xhr.send();
      xhr.onload = function() {
        if (xhr.status === 200){
          //Le jeu est ajouté
          text = "Jeu ajouté avec succès"
          ajouterMessage(text, form);
          //On vide les inputs
          boutonAjouterJeu.parentNode.children[1].value = ""
          boutonAjouterJeu.parentNode.children[3].value = ""
          boutonAjouterJeu.parentNode.children[7].value = ""
          boutonAjouterJeu.parentNode.children[9].value = ""
          for(var i=0; i<elementGenre.length; i++){
            elementGenre[i].className = "genreJeuAjoutJeu"
          }
          listeGenreSelect = []
        }
      }
    }
})

function ajouterMessage(text, parent, err=false){
  message = document.createElement("p");
  message.innerHTML = text
  if(err==true){
    message.className="ajoutJeuErr"
  }
  else{
    message.className="ajoutJeuSucc"
  }
  parent.appendChild(message)
  setTimeout(function() {
    parent.removeChild(message)
  }, 5000);
}