images = document.querySelectorAll('.articleImg');
images.forEach(image => {
    //Quand la souris est dessus
    image.addEventListener('mousemove', function addAnimation(e){
        const percentX = e.offsetX  / image.offsetWidth * 100;
        const percentY = e.offsetY  / image.offsetHeight * 100;
        const rotateX = (percentY - 50) / 50 * 20;
        const rotateY = (percentX - 50) / 50 * 20;
        console.log(e.offsetY)
        image.style.transform = `perspective(500px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
    })

    //Quand la souris n'est plus dessus
    image.addEventListener('mouseout', function removeAnimation(){
        image.style.transform = 'none';
    })

    //Quand on clique sur l'image
    image.addEventListener('click', function() {
        const modal = document.querySelector('#modal');
        const modalImage = document.querySelector('#modalImage');
        modalImage.src = this.src;
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
modal.addEventListener('click', function(event){
  if (event.target === modal) {
    modal.classList.remove('visible');
  }
});