<?php
require('./includes/php/config.inc.php');
require(MYSQL);
$page_title = 'Reset Your Password';
$page_class = 'reset_p';
include('./includes/php/header.inc.php');

//varibales for storing errors for reset and password errors resepectively
$reset_error = '';
$pass_errors = array();

?>
<!-- start of page specific content -->
<div class="inner-wrapper">
<?php

//check for a valid token in the URL
if (isset($_GET['t']) && (strlen($_GET['t']) === 64) ) {

  //store token
  $token = $_GET['t'];

  //COULD USE A PREDETERMINED SECURITY QUESTION HERE

  //fetch the user ID if a valid token (exists and has not expired)
  $q = 'SELECT user_id FROM access_tokens WHERE token=? AND date_expires > NOW()';
	$stmt = mysqli_prepare($dbc, $q);
	mysqli_stmt_bind_param($stmt, 's', $token);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);

  if (mysqli_stmt_num_rows($stmt) === 1) { //everthing OK

		mysqli_stmt_bind_result($stmt, $user_id);
		mysqli_stmt_fetch($stmt);

    //regenerate the session ID and store the user ID in the session
    session_regenerate_id(true);
    $_SESSION['SD_Fitness_Sess']['user_id'] = $user_id;

    //find the username associated with the user_id and set to session variable
    $q = "SELECT username FROM users WHERE id=$user_id";
    $r = mysqli_query($dbc, $q);

    if ($r) { //everthing OK

      $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
      $_SESSION['SD_Fitness_Sess']['username'] = $row['username'];

    } else {
      $reset_error = 'Either the provided token does not match that on file or your time has expired. Please resubmit the <a href="index.php?p=forgot_p">"Forgot your password?"</a> form. DOG';
    }

    //clear the token from the db
    $q = 'DELETE FROM access_tokens WHERE token=?';
    $stmt = mysqli_prepare($dbc, $q);
    mysqli_stmt_bind_param($stmt, 's', $token);
    mysqli_stmt_execute($stmt);

  } else {
    $reset_error = 'Either the provided token does not match that on file or your time has expired. Please resubmit the <a href="index.php?p=forgot_p">"Forgot your password?"</a> form.';

  }

} else { //no token
  $reset_error = 'This page has been accessed in error.';

} //END of token check


// If it's a POST request, handle the form submission:
if (isset($_POST['submitted']) && isset($_SESSION['SD_Fitness_Sess']['user_id'])) {

	// Okay to change password:
	$reset_error = '';

	// Check for a password and match against the confirmed password:
	// if (preg_match('/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*){6,}$/', $_POST['pass1']) ) {
  if (preg_match('/^[a-z]{2,}$/i', $_POST['pass1']) ) {
		if ($_POST['pass1'] == $_POST['pass2']) {
			$p = $_POST['pass1'];
		} else {
			$pass_errors['pass2'] = 'Your password did not match the confirmed password!';
		}
	} else {
		$pass_errors['pass1'] = 'Please enter a valid password!';
	}



  //if no errors then update the password in db
  if (empty($pass_errors)) {
    // Define the query:
    $q = 'UPDATE users SET pass=? WHERE id=? LIMIT 1';
    $stmt = mysqli_prepare($dbc, $q);
    mysqli_stmt_bind_param($stmt, 'si', $pass, $_SESSION['SD_Fitness_Sess']['user_id']);
    $pass = password_hash($p, PASSWORD_BCRYPT);
    mysqli_stmt_execute($stmt);

    //if succesful then complete the page
    if (mysqli_stmt_affected_rows($stmt) === 1) {

      // Send an email, if desired.

      // Let the user know the password has been changed:
      echo '<div class="success-wrapper"><h2>Your password has been changed.</h2></div>';
      echo '</div>'; //close inner-wrapper

      echo '<pre>' . print_r($_SESSION, 1) . '</pre>';

      include('./includes/php/footer.inc.php'); // Include the HTML footer.
      exit();

    } else { // If it did not run OK.
      echo 'Your password could not be changed due to a system error. We apologize for any inconvenience.';
      trigger_error('Your password could not be changed due to a system error. We apologize for any inconvenience.');

  }

} // End of empty($pass_errors) IF.
  echo '<div class="error-wrapper">';
  foreach($pass_errors as $error) {
    echo "<p class=\"pass-error\">$error</p>";
  }
  echo '<p>Please try again...</p></div>';

} elseif (isset($_POST['submitted'])) {
	$reset_error = 'This page has been accessed in error.';
} // End of the form submission conditional.

// If it's safe to change the password, show the form:
if (empty($reset_error)) {

  ?>
  <h2>Change Your Password</h2>

    <p>Use the form below to change your password.</p>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" accept-charset="utf-8">
      <fieldset>
        <div class="form-group">
          <label for="pass1">New Password:</label>
          <input type="password" name="pass1" required>
          <span class="help-block">*Must be at least 6 characters long, with at least one lowercase letter, one uppercase letter, and one number.</span>
        </div>
        <div class="form-group">
          <label for="pass2">Confirm New Password:</label>
          <input type="password" name="pass2" required>
        </div>
      	<input type="submit" name="submit_button" value="Change &rarr;" id="submit_button" class="btn btn-default" />
      </fieldset>
      <input type="hidden" name="submitted" value="TRUE">
    </form>

  <?php
} else {
	echo '<div class="reset-error-wrapper"><p>' . $reset_error . '</p></div>';
}

echo '</div>'; //end of inner-wrapper
include('./includes/php/footer.inc.php');
?>
