<?php # forgot_password.inc.php
/* this page is the forgot password content module (reset users password)
* this page is included by index.php
*/


// Redirect if this page was accessed directly:
//(check if a constant is defined - if not redirect
if (!defined('BASE_URL')) {

    // Need the BASE_URL, defined in the config file:
    // require('./includes/php/config.inc.php');

    //config file already includeds by index.php for BASE_URL and redirect_invalid_user function

    // Redirect to the index page:
    $url = BASE_URL . 'index.php';
    header ("Location: $url");
    exit;

} // End of defined() IF.


//need db connection
require(MYSQL);

//array for storing errors
$pass_errors = array();

?>
<!-- start of page specific content -->
<div class="inner-wrapper">
<?php

//check if the login form has been submitted (checking POST variable is set and hidden form field has been submited)
if(isset($_POST['submitted'])) {

	  // Validate the email address:
	  if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

		    $email = $_POST['email'];

		    // Check for the existence of that email address...
		    $q = 'SELECT id FROM users WHERE email="'.  escape_data($email, $dbc) . '"';
		    $r = mysqli_query($dbc, $q);

		    if (mysqli_num_rows($r) === 1) { // Retrieve the user ID:
			       list($uid) = mysqli_fetch_array($r, MYSQLI_NUM);
		    } else { // No database match made.
			       $pass_errors['email'] = $lang['email_not_on_file'];
		    }

	  } else { // No valid address submitted.
		$pass_errors['email'] = $lang['invalid_email'];

    } // End of $_POST['email'] IF.

    if (empty($pass_errors)) {  //if everything's OK

      //create a random token which is comprised of the 32 random bytes and conver it from a binary value into a hex value (which is 64 characters)
      $token = openssl_random_pseudo_bytes(32);
      $token = bin2hex($token);

      //store the token in the db (using REPLACE) and make last only 15 mins
      $q = 'REPLACE INTO access_tokens (user_id, token, date_expires) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 15 MINUTE))';
      $stmt = mysqli_prepare($dbc, $q);
      mysqli_stmt_bind_param($stmt, 'is', $uid, $token);
      mysqli_stmt_execute($stmt);

      if (mysqli_stmt_affected_rows($stmt) > 0) { //everything OK

        //create reset URL (link in reset email)
        // $url = 'https://' . BASE_URL . 'reset.php?t=' . $token;
        $url = 'http://' . BASE_URL . 'reset.php?t=' . $token;

        //send the email
        $body = $lang['password_reset_email_p1'] .' '. $url .' '. $lang['password_reset_email_p2'] ;
        // mail($email, 'Password Reset at Knowledge is Power', $body, 'FROM: ' . CONTACT_EMAIL);

        //display msg and end page
        echo $lang['reset_password_msg'];

        // TODO: PRINT LINK FOR TESTING PURPOSES ONLY
        echo "<p>Link:<a href=\"$url\">$url</a></p>";

        exit();

			} else { // If it did not run OK.
            echo '<div class="error-wrapper"><p class="pass-error">' . $lang['password_not_reset'] . '</p></div>';
						trigger_error('Your password could not be changed due to a system error. We apologize for any inconvenience.');

			} //END OF update query IF

		} //END OF empty($pass_errors) IF
    //print errors
    echo '<div class="error-wrapper">';
    foreach($pass_errors as $error) {
      echo "<p class=\"pass-error\">$error</p>";
    }
    echo '<p>' . $lang['try_again'] . '</p></div>';

} //END OF main Submit conditional
?>
<h2><?php echo $lang['reset_password_title']; ?></h2>
<p><?php echo $lang['reset_password_brief']; ?></p>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?p=forgot_p" method="post" accept-charset="utf-8">
  <fieldset>
    <div class="form-group">
      <label for="email"><?php echo $lang['email_address']; ?></label>
      <input type="email" name="email" required autofocus>
    </div>
    <input type="submit" name="submit_button" value="Reset &rarr;">
  </fieldset>
  <input type="hidden" name="submitted" value="TRUE">
</form>








</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
