//form_language = the langauge set on the website

//transition times
const shakeTime = 100;  //shake transition time (in ms)
const switchTime = 200;   //transition between questions

//init position at first question
let position = 0;

//init DOM elements
const formBox = document.querySelector('#form-box');
const nextBtn = document.querySelector('#next-btn');
const prevBtn = document.querySelector('#prev-btn');
const inputGroup = document.querySelector('#input-group');
const inputField = document.querySelector('#input-field');
const inputLabel = document.querySelector('#input-label');
const inputProgress = document.querySelector('#input-progress');
const progress = document.querySelector('#progress-bar');
const formTitle = document.querySelector('h1.logo');

//if ENGLISH
if (form_language == 'en') {
  //questions array
  const questions = [
    { question: 'Enter Your Email Address', pattern: /\S+@\S+\.\S+/},
    { question: 'Enter Your Password', type: 'password'}
  ];

  // EVENTS
  //get question on DOM load
  document.addEventListener('DOMContentLoaded', getQuestion);
  //next button click
  nextBtn.addEventListener('click', validate);
  //input field enter button click
  inputField.addEventListener('keyup', e => {
    if (e.keyCode == 13) {
      validate();
    }
  });


  // FUNCTIONS

  //get question from array & add to markup
  function getQuestion() {
    //get the question at the current question
    inputLabel.innerHTML = questions[position].question;
    //get the current type (set to text if type is not defined for object
    inputField.type = questions[position].type || 'text';
    //get current answer
    inputField.value = questions[position].answer || '';
    //focus on the current element
    inputField.focus();

    //set the progress bar width (variable to the % questions length)
    progress.style.width = (position * 100) / questions.length + '%'

    //add user icon OR back arrow depending on the question
    //uses ternary operator to ask if position is 0 (if it's the first element)
    prevBtn.className = position ? 'fas fa-arrow-left' : 'fas fa-user';

    showQuestion();
  }

  //display the question to the user
  function showQuestion() {
    inputGroup.style.opacity = 1;
    inputProgress.style.transition = '';
    inputProgress.style.width = '100%';
  }

  //hide the question from the user
  function hideQuestion() {
    inputGroup.style.opacity = 0;
    inputLabel.style.marginLeft = 0;
    inputProgress.style.width = 0;
    inputProgress.style.transition = 'none';
    inputGroup.style.border = null;
  }

  //transform to create shake motion
  function transform(x,y) {
    formBox.style.transform = `translate(${x}px, ${y}px)`;
  }

  //validate field
  function validate() {
    //make sure pattern matches if there is one
    if (!inputField.value.match(questions[position].pattern || /.+/)) {
      inputFail();
    } else {
      inputPass();
    }
  }

  //field input fail
  function inputFail() {
    formBox.className = 'error';
    //repeat shake motion (set i to number of shakes) - side to side
    for(let i=0; i < 6; i++) {
      setTimeout(transform, shakeTime * i, ((i % 2) * 2 - 1) * 20, 0);
      setTimeout(transform, shakeTime * 6, 0, 0);
      inputField.focus();
    }
  }

  //field input pass
  function inputPass() {
    //remove error class if second try is a pass
    formBox.className = '';
    //make box shake up and down
    setTimeout(transform, shakeTime * 0, 0, 10);
    setTimeout(transform, shakeTime * 1, 0, 0);

    //store answer in the questions array
    questions[position].answer = inputField.value;

    //increment position
    position++;

    //if new question, then hide the current and get the next
    if (questions[position]) {
      hideQuestion();
      getQuestion();
    } else {
      //no more questions left  (remove)
      hideQuestion();
      formBox.className = 'close';
      progress.style.width = '100%';

      //form complete
      formComplete();
    }

  }

  //all fields complete - show 1 end
  function formComplete() {
    // console.log(questions);

    //remove form title
    formTitle.style.opacity = 0;
    //create a h1 element with the class of end
    const response = document.createElement('h1');
    response.classList.add('end');
    //add the response from the php script to the h1 element
    // response.appendChild(document.createTextNode());
    setTimeout(() => {
      formBox.parentElement.appendChild(response);
      setTimeout(() => (response.style.opacity = 1), 50);
    }, 1000);

    //get email and password from questions array
    var e = questions[0].answer;
    var p = questions[1].answer;


    //create ajax and send to php script for validation
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("GET", "./includes/ajax/login_validation.php?e=" + e + "&p=" + p, true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
        //check php validation status
        if (this.responseText == 'TRUE') { //VALID

          // DEBUG: for testing
          // response.innerHTML = this.responseText;

          response.innerHTML = "You are now logged in...";

          //redirect to view purchases page
          setTimeout(() => {
            window.location = 'index.php?p=view_p';
          }, 4000);

        } else { //INVALID

          response.innerHTML = this.responseText;
          //redirect user to login form again
          setTimeout(() => {
            window.location = 'index.php?p=login';
          }, 4000);

        }

      } else { //waiting for response
        response.innerHTML = "Loading...";
      }
    }
    //send the questions array
    xmlhttp.send();
  }


} else if (form_language == 'fr') { //if FRENCH
  const questions = [
    { question: 'Entrez Vorte Adresse Email', pattern: /\S+@\S+\.\S+/},
    { question: 'Tapez Votre mot de Passe', type: 'password'}
  ];

  // EVENTS
  //get question on DOM load
  document.addEventListener('DOMContentLoaded', getQuestion);
  //next button click
  nextBtn.addEventListener('click', validate);
  //input field enter button click
  inputField.addEventListener('keyup', e => {
    if (e.keyCode == 13) {
      validate();
    }
  });


  // FUNCTIONS

  //get question from array & add to markup
  function getQuestion() {
    //get the question at the current question
    inputLabel.innerHTML = questions[position].question;
    //get the current type (set to text if type is not defined for object
    inputField.type = questions[position].type || 'text';
    //get current answer
    inputField.value = questions[position].answer || '';
    //focus on the current element
    inputField.focus();

    //set the progress bar width (variable to the % questions length)
    progress.style.width = (position * 100) / questions.length + '%'

    //add user icon OR back arrow depending on the question
    //uses ternary operator to ask if position is 0 (if it's the first element)
    prevBtn.className = position ? 'fas fa-arrow-left' : 'fas fa-user';

    showQuestion();
  }

  //display the question to the user
  function showQuestion() {
    inputGroup.style.opacity = 1;
    inputProgress.style.transition = '';
    inputProgress.style.width = '100%';
  }

  //hide the question from the user
  function hideQuestion() {
    inputGroup.style.opacity = 0;
    inputLabel.style.marginLeft = 0;
    inputProgress.style.width = 0;
    inputProgress.style.transition = 'none';
    inputGroup.style.border = null;
  }

  //transform to create shake motion
  function transform(x,y) {
    formBox.style.transform = `translate(${x}px, ${y}px)`;
  }

  //validate field
  function validate() {
    //make sure pattern matches if there is one
    if (!inputField.value.match(questions[position].pattern || /.+/)) {
      inputFail();
    } else {
      inputPass();
    }
  }

  //field input fail
  function inputFail() {
    formBox.className = 'error';
    //repeat shake motion (set i to number of shakes) - side to side
    for(let i=0; i < 6; i++) {
      setTimeout(transform, shakeTime * i, ((i % 2) * 2 - 1) * 20, 0);
      setTimeout(transform, shakeTime * 6, 0, 0);
      inputField.focus();
    }
  }

  //field input pass
  function inputPass() {
    //remove error class if second try is a pass
    formBox.className = '';
    //make box shake up and down
    setTimeout(transform, shakeTime * 0, 0, 10);
    setTimeout(transform, shakeTime * 1, 0, 0);

    //store answer in the questions array
    questions[position].answer = inputField.value;

    //increment position
    position++;

    //if new question, then hide the current and get the next
    if (questions[position]) {
      hideQuestion();
      getQuestion();
    } else {
      //no more questions left  (remove)
      hideQuestion();
      formBox.className = 'close';
      progress.style.width = '100%';

      //form complete
      formComplete();
    }

  }

  //all fields complete - show 1 end
  function formComplete() {
    // console.log(questions);

    //remove form title
    formTitle.style.opacity = 0;
    //create a h1 element with the class of end
    const response = document.createElement('h1');
    response.classList.add('end');
    //add the response from the php script to the h1 element
    // response.appendChild(document.createTextNode());
    setTimeout(() => {
      formBox.parentElement.appendChild(response);
      setTimeout(() => (response.style.opacity = 1), 50);
    }, 1000);

    //get email and password from questions array
    var e = questions[0].answer;
    var p = questions[1].answer;


    //create ajax and send to php script for validation
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("GET", "./includes/ajax/login_validation.php?e=" + e + "&p=" + p, true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
        //check php validation status
        if (this.responseText == 'TRUE') { //VALID

          // DEBUG: for testing
          // response.innerHTML = this.responseText;

          response.innerHTML = "Vous êtes maintenant connecté...";

          //redirect to view purchases page
          setTimeout(() => {
            window.location = 'index.php?p=view_p';
          }, 4000);

        } else { //INVALID

          response.innerHTML = this.responseText;
          //redirect user to login form again
          setTimeout(() => {
            window.location = 'index.php?p=login';
          }, 4000);

        }

      } else { //waiting for response
        response.innerHTML = "Chargement...";
      }
    }
    //send the questions array
    xmlhttp.send();
  }

}
