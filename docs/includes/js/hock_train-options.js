const left = document.querySelector('.left');
const right = document.querySelector('.right');
const middle = document.querySelector('.middle');
const container = document.querySelector('.options-wrapper');

// console.log(document.documentElement.clientWidth);

//check to see if the client is using a screen width larger than 500 before
//running JS
if (document.documentElement.clientWidth > 500) {

  left.addEventListener('mouseenter', () => {
    container.classList.add('hover-left');
    middle.style.left = '60%';
  });

  left.addEventListener('mouseleave', () => {
    container.classList.remove('hover-left');
    middle.style.left = '33.33%';
  });

  right.addEventListener('mouseenter', () => {
    container.classList.add('hover-right');
    middle.style.left = '20%';
  });

  right.addEventListener('mouseleave', () => {
    container.classList.remove('hover-right');
    middle.style.left = '33.33%';
  });

  middle.addEventListener('mouseenter', () => {
    container.classList.add('hover-middle');
    middle.style.left = '20%';
  });

  middle.addEventListener('mouseleave', () => {
    container.classList.remove('hover-middle');
    middle.style.left = '33.33%';
  });

}
