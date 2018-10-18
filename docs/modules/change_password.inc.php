<?php # change_password.inc.php
/* this page is the change password content module (user can change their password)
* this page is included by index.php
*/


// Redirect if this page was accessed directly:
//(check if a constant is defined - if not redirect
if (!defined('BASE_URL')) {

    // Need the BASE_URL, defined in the config file:
    // require('../includes/php/config.inc.php');

    //config file already includeds by index.php for BASE_URL and redirect_invalid_user function

    // Redirect to the index page:
    $url = BASE_URL . 'index.php';
    header ("Location: $url");
    exit;

} // End of defined() IF.

//redirect if the user isn't logged in
redirect_invalid_user();

//need db connection
require(MYSQL);

//array for storing errros
$pass_errrors = array();

?>
<!-- start of page specific content -->
<div class="inner-wrapper">
<?php

//check if the login form has been submitted (checking POST variable is set and hidden form field has been submited)
if(isset($_POST['submitted'])) {

	// Check for the existing password:
	if (!empty($_POST['current'])) {
		$current = $_POST['current'];
	} else {
		$pass_errors['current'] = $lang['enter_current_password'];
	}

	// Check for a password and match against the confirmed password:
  // TODO: CHANGE REGEX TO COMMENTED OUT BELOW
	// if (preg_match('/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*){6,}$/', $_POST['pass1']) ) {
  if (preg_match('/^[a-z]{2,}$/i', $_POST['pass1']) ) {
		if ($_POST['pass1'] == $_POST['pass2']) {
			$p = $_POST['pass1'];
		} else {
			$pass_errors['pass2'] = $lang['password_no_match'];
		}
	} else {
		$pass_errors['pass1'] = $lang['invalid_password'];
	}

	if (empty($pass_errors)) { // If everything's OK.

		// Check the current password:
		$q = "SELECT pass FROM users WHERE id={$_SESSION['SD_Fitness_Sess']['user_id']}";
		$r = mysqli_query($dbc, $q);
		list($hash) = mysqli_fetch_array($r, MYSQLI_NUM);

		// Validate the password:
		if (password_verify($current, $hash)) { // Correct!

			// create the update query:
			$q = "UPDATE users SET pass='"  .  password_hash($p, PASSWORD_BCRYPT) .  "' WHERE id={$_SESSION['SD_Fitness_Sess']['user_id']} LIMIT 1";
			if ($r = mysqli_query($dbc, $q)) { // If it ran OK.

				// Send an email, if desired.

				// Let the user know the password has been changed:
				echo '<h2 class="complete">' . $lang['password_has_changed'] . '</h2>';
        //redirect user to their purchases
        $url = 'index.php?p=view_p';
        header("refresh:3; url=$url");
        exit();


			} else { // If it did not run OK.
        echo '<div class="error-wrapper"><p class="pass-error">' . $lang['password_not_changed'] . '</p></div>';
				trigger_error('Your password could not be changed due to a system error. We apologize for any inconvenience.');
			}

		} else { // Invalid password.
			$pass_errors['current'] = $lang['password_incorrect'];
		}

	} // End of empty($pass_errors) IF.
  //print errors
  echo '<div class="error-wrapper">';
  foreach($pass_errors as $error) {
    echo "<p class=\"pass-error\">$error</p>";
  }
  echo '<p>' . $lang['try_again'] . '</p></div>';

} // End of the form submission conditional.

//create the form
?>

  <h2><?php echo $lang['change_your_password']; ?></h2>

  <p><?php echo $lang['use_form_to_change_password']; ?></p>
  <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?p=change_p" method="post" accept-charset="utf-8">
    <fieldset>
      <div class="form-group">
        <label for="current"><?php echo $lang['current_password']; ?></label>
        <input type="password" name="current" required autofocus>
      </div>
      <div class="form-group">
        <label for="pass1"><?php echo $lang['new_password']; ?></label>
        <input type="password" name="pass1" required>
        <span class="help-block"><?php echo $lang['password_constraint']; ?></span>
      </div>
      <div class="form-group">
        <label for="pass2"><?php echo $lang['confirm_new_password']; ?></label>
        <input type="password" name="pass2" required>
      </div>
    	<input type="submit" name="submit_button" value="<?php echo $lang['change']; ?> &rarr;" id="submit_button" class="btn btn-default" />
    </fieldset>
    <input type="hidden" name="submitted" value="TRUE">
  </form>




</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
