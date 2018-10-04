const left = document.querySelector('.left');
const right = document.querySelector('.right');
const container = document.querySelector('.options-wrapper');

// console.log(document.documentElement.clientWidth);

//check to see if the client is using a screen width larger than 500 before
//running JS
if (document.documentElement.clientWidth > 500) {

  left.addEventListener('mouseenter', () => {
    container.classList.add('hover-left');
  });

  left.addEventListener('mouseleave', () => {
    container.classList.remove('hover-left');
  });

  right.addEventListener('mouseenter', () => {
    container.classList.add('hover-right');
  });

  right.addEventListener('mouseleave', () => {
    container.classList.remove('hover-right');
  });

}
