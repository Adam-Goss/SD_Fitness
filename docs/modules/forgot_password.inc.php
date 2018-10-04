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
			       $pass_errors['email'] = 'The submitted email address does not match those on file!';
		    }

	  } else { // No valid address submitted.
		$pass_errors['email'] = 'Please enter a valid email address!';

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
        $body = "This email is in response to a forgotten password reset request at 'Knowledge is Power'. If you did make this request, click the following link to be able to access your account:
        $url
        For security purposes, you have 15 minutes to do this. If you do not click this link within 15 minutes, you'll need to request a reset again. If you have not forgotten your password you can safely ignore this message and you will still be able to login with your existing password. ";
        // mail($email, 'Password Reset at Knowledge is Power', $body, 'FROM: ' . CONTACT_EMAIL);

        //display msg and end page
        echo '<h2 class="complete">Reset Your Password</h1><p>You will receive an access code via email. Click the link in that email to gain access to the site. Once you have done that, you may then change your password.</p>';

        // TODO: PRINT LINK FOR TESTING PURPOSES ONLY
        echo "<p>Link:<a href=\"$url\">$url</a></p>";

        exit();

			} else { // If it did not run OK.
            echo '<div class="error-wrapper"><p class="pass-error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p><p>Please try again...</p></div>';
						trigger_error('Your password could not be changed due to a system error. We apologize for any inconvenience.');

			} //END OF update query IF

		} //END OF empty($pass_errors) IF
    //print errors
    echo '<div class="error-wrapper">';
    foreach($pass_errors as $error) {
      echo "<p class=\"pass-error\">$error</p>";
    }
    echo '<p>Please try again...</p></div>';

} //END OF main Submit conditional
?>
<h2>Reset Your Password</h2>
<p>Enter your email address below to reset your password.</p>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?p=forgot_p" method="post" accept-charset="utf-8">
  <fieldset>
    <div class="form-group">
      <label for="email">Email Address:</label>
      <input type="email" name="email" required autofocus>
    </div>
    <input type="submit" name="submit_button" value="Reset &rarr;">
  </fieldset>
  <input type="hidden" name="submitted" value="TRUE">
</form>








</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
