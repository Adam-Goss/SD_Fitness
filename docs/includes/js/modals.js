// get modal element
var modal = document.getElementById('athlete1-modal');
//get open modal button
var modalBtn = document.getElementById('modalBtn');
//get close button (first one)
var closeBtn = document.getElementsByClassName('closeBtn')[0];

//listen for open click
modalBtn.addEventListener('click', openModal);
//listen for close click
closeBtn.addEventListener('click', closeModal);
//listen for outside click
window.addEventListener('click', clickOutside);

//function to open modal
function openModal(e) {
  e.preventDefault();
  modal.style.display = 'block';
}

//function to close modal
function closeModal() {
  modal.style.display = 'none';
}

//function to close modal if outside click
function clickOutside(e) {
  //if the click is outside the modal content
  if (e.target == modal) {
    modal.style.display = 'none';
  }
}
