const articles = document.querySelectorAll('.article');

articles.forEach(article => {
  article.addEventListener('mousemove', e => {
    const percentX = (e.clientX - article.offsetLeft) / article.offsetWidth * 100;
    const percentY = (e.clientY - article.offsetTop) / article.offsetHeight * 100;
    const rotateX = (percentY - 50) / 50 * 10;
    const rotateY = (percentX - 50) / 50 * 10;
    article.style.transform = `perspective(500px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
  });

  article.addEventListener('mouseout', () => {
    article.style.transform = 'none';
  });
});

