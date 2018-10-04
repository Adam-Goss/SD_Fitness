<?php //script to validate user login


/*------------------------------------------------------
# validate user login coming from JS form (ajax request)
-------------------------------------------------------*/
//need config file
require('../php/config.inc.php');

//need db connection
require(MYSQL);

//array for recording errors
$reg_errors = array();

//validate the first name // DEBUG: ADD VALIDATION
if (preg_match('/^[A-Z \' .-]{2,45}$/i', $_GET['fn'])) {
   $fn = $_GET['fn'];
} else {
   $reg_errors['fn'] = 'Please enter your first name!';
}

//validate the last name // DEBUG: ADD VALIDATION
if (preg_match('/^[A-Z \' .-]{2,45}$/i', $_GET['ln'])) {
   $ln = $_GET['ln'];
} else {
   $reg_errors['ln'] = 'Please enter your last name!';
}

//validate the username // DEBUG: ADD VALIDATION
if (preg_match('/^[A-Z0-9]{2,45}$/i', $_GET['un'])) {
   $un = $_GET['un'];
} else {
   $reg_errors['un'] = 'Please enter your username!';
}

//validate the email address
if (filter_var($_GET['e'], FILTER_VALIDATE_EMAIL)) {
   $e = escape_data($_GET['e'], $dbc);
} else {
   $reg_errors['e'] = 'Please enter a valid email address!';
}

//validate the password and confirm against confirmation password:
// TODO: CHANGE REGEX TO COMMENTED OUT BELOW
// if (preg_match('/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*){6,}$/', $_GET['p']) ) {
if (preg_match('/^[a-z]{2,}$/i', $_GET['p']) ) {
  if ($_GET['p'] === $_GET['cp']) {
	   $p = $_GET['p'];
  } else {
	   $reg_errors['cp'] = 'Your password did not match the confirmed password!';
	}
} else {
  $reg_errors['p'] = 'Please enter a valid password!';
}


if (empty($reg_errors)) { //OK to proceed

  // echo 'TRUE';

  //make sure the email address and username are avaliable:
  $q = "SELECT email, username FROM users WHERE email='$e' OR username='$un'";
  $r = mysqli_query($dbc, $q);

  //get the number of rows returned:
  $rows = mysqli_num_rows($r);

  if ($rows == 0) { //unique user

    //add the user to the db (using prepared statements):
    //(sets expriation to 1 month from now)

    $q = "INSERT INTO users (username, email, pass, first_name, last_name, date_expires) VALUES (?, ?, ?, ?, ?, SUBDATE(NOW(), INTERVAL -1 MONTH) )";
    $stmt = mysqli_prepare($dbc, $q);
    mysqli_stmt_bind_param($stmt, 'sssss', $un, $e, $pass, $fn, $ln);
    $pass = password_hash($p, PASSWORD_BCRYPT);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) === 1) { // If it ran OK

      //close prepared stmt
      mysqli_stmt_close($stmt);

      //display a thank you msg:
      echo 'TRUE';

      //send out an email:
      // $body = "Thank you for registering at <whatever site>. Blah. Blah. Blah.\n\n";
      // mail($_GET['e'], 'Registration Confirmation', $body, 'From: admin@example.com');

      //get the user data from db and store the data in a session (if successful):
      $q = "SELECT id, username FROM users WHERE email=?";
      $stmt = mysqli_prepare($dbc, $q);
      mysqli_stmt_bind_param($stmt, 's', $e);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);

      if (mysqli_stmt_num_rows($stmt) == 1) { // A match was made.

          //get the data
          mysqli_stmt_bind_result($stmt, $user_id, $username);
          mysqli_stmt_fetch($stmt);
          mysqli_stmt_close($stmt);

          //store the data in a session:
          $_SESSION['SD_Fitness_Sess']['user_id'] = $user_id;
          $_SESSION['SD_Fitness_Sess']['username'] = $username;

      } else { //query didn't run correctly
        trigger_error('You could not be registered due to a system error. We apologize for any inconvenience. We will correct the error ASAP.');
        echo ('You could not be registered due to a system error. We apologize for any inconvenience. We will correct the error ASAP.');
      }  //end of if SELECT query == 1

    } else { //if the INSERT query did not run OK
        trigger_error('You could not be registered due to a system error. We apologize for any inconvenience. We will correct the error ASAP.');
        echo ('You could not be registered due to a system error. We apologize for any inconvenience. We will correct the error ASAP.');
    }

  } else { //the email address or username is not avaliable

    if ($rows == 2) { //both are taken

        $reg_errors['e'] = 'This email address has already been registered. If you have forgotten your password, use the link below to have your password sent to you.<br><a href="index.php?p=forgot_p">Forgot password?</a>';
        $reg_errors['un'] = 'This username has already been registered. Please try another.';

    } else { //one or both may be taken

      //get row:
      $row = mysqli_fetch_array($r, MYSQLI_NUM);

      if( ($row[0] === $e) && ($row[1] === $un) ) { // Both match.
         $reg_errors['e_un'] = 'This email address and username has already been registered. If you have forgotten your password, use the link below to have your password sent to you.<br><a href="index.php?p=forgot_p">Forgot password?</a>';

    	} elseif ($row[0] === $e) { // Email match.
         $reg_errors['e'] = 'This email address has already been registered. If you have forgotten your password, use the link below to have your password sent to you.<br><a href="index.php?p=forgot_p">Forgot password?</a>';

      } elseif ($row[1] === $un) { // Username match.
         $reg_errors['un'] = 'This username has already been registered. Please try another.';
  		}

    }   //END OF $rows == 2 ELSE
    foreach($reg_errors as $error) {
      echo "$error<br>";
    }

  }   //END OF $rows == 0 IF

} else { //END OF empty($reg_errors) IF
  foreach($reg_errors as $error) {
    echo "$error<br>";
  }
}


















?>
