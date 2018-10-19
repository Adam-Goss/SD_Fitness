<?php //script to validate user login


/*------------------------------------------------------
# validate user login coming from JS form (ajax request)
-------------------------------------------------------*/
//need config file
require('../php/config.inc.php');

//need db connection
require(MYSQL);

//array for recording errors
$login_errors = array();

//validate the email address
if (filter_var($_GET['e'], FILTER_VALIDATE_EMAIL)) {
   $e = escape_data($_GET['e'], $dbc);
} else {
   $login_errors['e'] = $lang['valid_email_address'];
}

//validate the password:
if (!empty($_GET['p'])) {
   $p = $_GET['p'];
} else {
   $login_errors['p'] = $lang['enter_your_password'];
}


if (empty($login_errors)) { //OK to proceed

  //query the db using a prepared statement
  $q = "SELECT id, username, pass FROM users WHERE email=?";
  $stmt = mysqli_prepare($dbc, $q);
  mysqli_stmt_bind_param($stmt, 's', $e);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);

  if (mysqli_stmt_num_rows($stmt) == 1) { // A match was made.

      //get the data
      mysqli_stmt_bind_result($stmt, $user_id, $username, $pass);
      mysqli_stmt_fetch($stmt);
      mysqli_stmt_close($stmt);

      //validate the password:
      if (password_verify($p, $pass)) {  //correct
      // if ($p === $pass) { //FOR DEBUGGING PURPOSES CHANGE TO ABOVE WHEN DONE W/ DEBUG

        //store the data in a session:
        $_SESSION['SD_Fitness_Sess']['user_id'] = $user_id;
        $_SESSION['SD_Fitness_Sess']['username'] = $username;

        //return true
        echo 'TRUE';


      } else {  //right email address but invalid password
        echo $lang['wrong_email_address_password'];

      }   //END OF validate password IF

  } else {  //no match was made (technically, only the email address failed)
    echo $lang['wrong_email_address_password'];

  }

} else { //errors getting the email and password from JS
  //return login errors array
  foreach($login_errors as $error) {
    echo "$error<br>";
  }

}//end of $login_errors empty IF
foreach($login_errors as $error) {
  echo "$error<br>";
}



?>
