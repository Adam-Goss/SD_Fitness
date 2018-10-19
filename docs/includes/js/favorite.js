
  var addFavLink = document.querySelector('#add_favorite_link');
  var removeFavLink = document.querySelector('#remove_favorite_link');
  var favLink= document.querySelector('#favorite_h3');

// document.addEventListener('DOMContentLoaded', function(event) {


//check if links exists and add event listener to existing link
if(addFavLink != null) {
  addFavLink.addEventListener('click', function(e) {
    manage_favorites('add');
    // console.log('add');
    e.preventDefault();
  });

} else {
  removeFavLink.addEventListener('click', function(e) {
    manage_favorites('remove');
    // console.log('remove');
    e.preventDefault();
  });
}

function manage_favorites(action) {
  //create ajax and send to php script for validation
  var xmlhttp = new XMLHttpRequest();

  xmlhttp.open("GET", "./includes/ajax/favorite.php?action="+action+"&blog_id="+blog_id+"&user_id="+user_id, true);
  xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xmlhttp.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      //check php validation status
      // console.log(this.responseText);
      if (this.responseText === 'true') { //VALID
        update_page(action);
        console.log('ajax good');
        console.log(this.responseText);
      } else { //INVALID
        //do somthing
        console.log('ajax bad');
        console.log(this.responseText);


      }

    } else { //waiting for response
      //do somthing (waiting for server to be ready
      console.log(this.responseText);
    };
  }
  xmlhttp.send();
}

function update_page(action) {
  if (action === 'add') {
    //update html

    //if ENGLISH
    if (form_language == 'en') {
      favLink.innerHTML = '<i class="far fa-thumbs-up"></i><span class="label label-info">This is a favorite!</span><a id="remove_favorite_link" title="remove favorite" href=""><i class="far fa-thumbs-down"></i></a></h3>';
    } else if (form_language == 'fr') { //if FRENCH
      favLink.innerHTML = '<i class="far fa-thumbs-up"></i><span class="label label-info">C\'est un favori!</span><a id="remove_favorite_link" title="remove favorite" href=""><i class="far fa-thumbs-down"></i></a></h3>';
    }
    //add event handler for remove link
    var removeFavLink = document.querySelector('#remove_favorite_link');
    removeFavLink.addEventListener('click', (e) => {
      manage_favorites('remove');
      e.preventDefault();
      console.log('remove second time');
    });

  } else {
    //if ENGLISH
    if (form_language == 'en') {
      favLink.innerHTML = '<span class="label label-info">Make this a favorite!</span><a id="add_favorite_link" title="favorite page" href=""><i class="far fa-thumbs-up"></i></a>';
    } else if (form_language == 'fr') { //if FRENCH
      favLink.innerHTML = '<span class="label label-info">Faire c\'est un favori!</span><a id="add_favorite_link" title="favorite page" href=""><i class="far fa-thumbs-up"></i></a>';
    }
    var addFavLink = document.querySelector('#add_favorite_link');
    addFavLink.addEventListener('click', (e) => {
      manage_favorites('add');
      e.preventDefault();
      console.log('add second time');
    });
   }
} // End of update_page() function.

// });
