

// TODO: CHANGE TO MAKE BETTER


var i = 0;  //start point
var images = [];
var time = 2500;

//image list
images[0] = 'images/physique_male.jpg';
images[1] = 'images/physique_female.jpeg';
images[2] = 'images/shredded_male.jpeg';
images[3] = 'images/shredded_female.jpeg';

//change image
function changeImg() {
  //get the img tag (named slide in the document) and change it's source to the i'th elemnt in images (starts at 0)
  document.slide.src = images[i];

  //if i is less then the length of images[] then increment
  if (i < images.length - 1) {
    i++;
  } else {   //if i is the length of images[] then set back to 0 (starting point)
    i = 0;
  }

  //call the changeImg() again every 'time' (ms)
  setTimeout("changeImg()", time);

}

//call the changeImg() when the window (page) loads
window.onload = changeImg;
