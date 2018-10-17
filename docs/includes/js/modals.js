/* ----- interactive athlete modals ----- */

//get modals
let modals = document.querySelectorAll('.athlete-modal')
//get all open modal buttons
let modalBtns = document.querySelectorAll('.modalBtn');
//get all close buttons
let closeBtns = document.querySelectorAll('.closeBtn');

//listen for open click
for (let i=0; i < modalBtns.length; i++) {
  modalBtns[i].addEventListener('click', openModal);
  // console.log(modalBtns[i]);
}
//listen for close click
for (let i=0; i < closeBtns.length; i++) {
  closeBtns[i].addEventListener('click', closeModal);
}
//listen for outside click
window.addEventListener('click', clickOutside);

//function to open modal
function openModal(e) {
  e.preventDefault();
  e.target.nextElementSibling.style.display = 'block';
}

//function to close modal
function closeModal(e) {
  e.target.offsetParent.style.display = 'none';
}

//function to close modal if outside click
function clickOutside(e) {
  //if the click is outside the modal content
  for (let i=0; i < modals.length; i++) {
    if (e.target == modals[i]) {
      modals[i].style.display = 'none';
    }
  }
}
