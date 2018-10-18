<?php # main.inc.php
/* this page is the main content module (the homepage/default)
* this page is included by index.php
* this page displays the homepage and lets the user login
*/


// Redirect if this page was accessed directly:
// (check if a constant is defined - if not redirect
if (!defined('BASE_URL')) {

    // Need the BASE_URL, defined in the config file:
    // require('./includes/php/config.inc.php');

    //config file already includeds by index.php for BASE_URL and redirect_invalid_user function

    // Redirect to the index page:
    $url = BASE_URL . 'index.php';
    header ("Location: $url");
    exit;

} // End of defined() IF.



//check if the login form has been submitted (checking POST variable is set and hidden form
//field has been submitted
if(isset($_POST['submitted'])) {

  //need db connection
  require(MYSQL);

  //array for recording errors
  $login_errors = array();


  //validate the email address
  if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	   $e = escape_data($_POST['email'], $dbc);
  } else {
	   $login_errors['email'] = $lang['valid_email_address'];
  }

  //validate the password:
  if (!empty($_POST['pass'])) {
	   $p = $_POST['pass'];
  } else {
	   $login_errors['pass'] = $lang['enter_your_password'];
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

          // echo "<h3>true</h3>";

            //if admin, create a new session ID to be safe
            // if ($row['type'] == 'admin') {
            // if ($type == 'admin') {
            //     session_regenerate_id(true);
            //     $_SESSION['user_admin'] = true;
            // }

            //store the data in a session:
            $_SESSION['SD_Fitness_Sess']['user_id'] = $user_id;
			      $_SESSION['SD_Fitness_Sess']['username'] = $username;

            // echo '<pre>' . print_r($_SESSION, 1) . '</pre>';

            $url = 'index.php?p=view_p';
            header("Location: $url");

            //only indicate if the user' account is not expired:
            // if ($row['expired'] == 1) $_SESSION['user_not_expired'] = true;
            // if ($expired == 1) $_SESSION['user_not_expired'] = true;

        } else {  //right email address but invalid password
          $login_errors['login'] = $lang['wrong_email_address_password'];

        }   //END OF validate password IF

    } else {  //no match was made (technically, only the email address failed)
      $login_errors['login'] = $lang['wrong_email_address_password'];
    }

    //print the errors and redirect the user (no match made)
    echo '<div class="inner-wrapper">';
    foreach($login_errors as $error) {
      echo "<p class=\"login-error\">$error</p>";
    }
    echo '<p>' . $lang['redirecting'] . '</p></div>';
    $url = 'index.php?p=login';
    header("refresh:3; url=$url");

  } else {
    //print the errors and redirect the user (errors filling out form)
    echo '<div class="inner-wrapper">';
    foreach($login_errors as $error) {
      echo "<p class=\"login-error\">$error</p>";
    }
    echo '<p>' . $lang['redirecting'] . '</p></div>';
    $url = 'index.php?p=login';
    header("refresh:3; url=$url");


  }//end of $login_errors IF

// Omit the closing PHP tag to avoid 'headers already sent' errors!


} else {
  //display home page (with login form)

?>
<!-- start of page specific content -->
<div class="inner-wrapper">

  <!-- top container -->
  <section class="top-container">
    <div class="showcase">

      <!-- <h2>CONTAINS CARASOUL</h2> -->
      <img name="slide">

    </div>

    <div class="login-box">
      <?php //show login box only if customer is not logged in (no user id in session)
      if(isset($_SESSION['SD_Fitness_Sess']['username'])) {
        echo '
          <h3>Hi, ' . $_SESSION['SD_Fitness_Sess']['username'] . '</h3>
          <p class="logged-in-options">
            <span><a href="index.php?p=view_p">' . $lang['view_your_purchases'] . '</a></span><br>
            <span><a href="index.php?p=change_p">' . $lang['change_password'] . '</a></span><br>
            <span><a href="index.php?p=logout">' . $lang['logout'] . '</a></span><br>
          </p>
        ';
      } else { //show login form
        echo '
          <form action="' . htmlentities($_SERVER['PHP_SELF']) . '" method="post" accept-charset="utf-8">
            <fieldset>
              <h3>' . $lang['login'] . '</h3>
              <div class="form-group">
                <input type="email" name="email" id="email" class="form-control" placeholder="' . $lang['email_address'] . '">
              </div>
              <div class="form-group">
                <input type="password" name="pass" id="pass" class="form-control" placeholder="' . $lang['password'] . '">
              </div>
              <button type="submit" class=""><i class="fas fa-sign-in-alt fa-3x"></i></button>
              <span class="help-block"><a href="index.php?p=forgot_p">' . $lang['forgot_password'] . '</a></span>
          	</fieldset>
            <input type="hidden" name="submitted" value="TRUE">
          </form>
        ';
      }
      ?>
    </div>

  </section>


  <!-- testimonial section -->
  <section class="testimonials-container">
    <div class="tbox tbox-a">
      <h3><?php echo $lang['testimonial1_name']; ?></h3>
      <p><?php echo $lang['testimonial1_text']; ?></p>
    </div>
    <div class="tbox tbox-b">
      <h3><?php echo $lang['testimonial2_name']; ?></h3>
      <p><?php echo $lang['testimonial2_text']; ?></p>
    </div>
    <div class="tbox tbox-c">
      <h3><?php echo $lang['testimonial3_name']; ?></h3>
      <p><?php echo $lang['testimonial3_text']; ?></p>
    </div>
  </section>


  <!-- vid section -->
  <section class="vid-container">
    <h3><?php echo $lang['my_story']; ?></h3>
    <video src="images/bg_vid1.mov" autoplay loop></video>
  </section>

  <!-- mission section  -->
  <section class="mission-container">
    <div class="m-img">
      <img src="images/coach.jpeg" alt="Image of Coach">
    </div>
    <div class="m-text">
      <h3><?php echo $lang['my_mission']; ?></h3>
      <p><?php echo $lang['my_mission_text']; ?></p>
    </div>
  </section>

  <!-- athletes section -->
  <section class="athletes">
    <h3><?php echo $lang['sd_fitness_athletes']; ?></h3>
    <div class="athletes-container">

      <div class="athlete">
        <img src="images/athlete1.jpeg" alt="Image of athlete">
        <a href="" class="modalBtn"><?php echo $lang['athlete1_name']; ?></a>
        <div class="athlete-modal">
          <div class="modal-content">
            <div class="modal-header">
              <span class="closeBtn">&times;</span>
              <h3><?php echo $lang['athlete1_name']; ?></h3>
            </div>
            <div class="modal-body">
              <p><?php echo $lang['athlete1_text']; ?></p>
              <img src="images/athlete1.jpeg" alt="Image of athlete">
            </div>
          </div>
        </div>
      </div>
      <div class="athlete">
        <img src="images/athlete2.jpeg" alt="Image of athlete">
        <a href="" class="modalBtn"><?php echo $lang['athlete2_name']; ?></a>
        <div class="athlete-modal">
          <div class="modal-content">
            <div class="modal-header">
              <span class="closeBtn">&times;</span>
              <h3><?php echo $lang['athlete2_name']; ?></h3>
            </div>
            <div class="modal-body">
              <p><?php echo $lang['athlete2_text']; ?></p>
              <img src="images/athlete2.jpeg" alt="Image of athlete">
            </div>
          </div>
        </div>
      </div>
      <div class="athlete">
        <img src="images/athlete3.jpg" alt="Image of athlete">
        <a href="" class="modalBtn"><?php echo $lang['athlete3_name']; ?></a>
        <div class="athlete-modal">
          <div class="modal-content">
            <div class="modal-header">
              <span class="closeBtn">&times;</span>
              <h3><?php echo $lang['athlete3_name']; ?></h3>
            </div>
            <div class="modal-body">
              <p><?php echo $lang['athlete3_text']; ?></p>
              <img src="images/athlete3.jpg" alt="Image of athlete">
            </div>
          </div>
        </div>
      </div>
      <div class="athlete">
        <img src="images/athlete2.jpeg" alt="Image of athlete">
        <a href="" class="modalBtn"><?php echo $lang['athlete4_name']; ?></a>
        <div class="athlete-modal">
          <div class="modal-content">
            <div class="modal-header">
              <span class="closeBtn">&times;</span>
              <h3><?php echo $lang['athlete4_name']; ?></h3>
            </div>
            <div class="modal-body">
              <p><?php echo $lang['athlete4_text']; ?></p>
              <img src="images/athlete2.jpeg" alt="Image of athlete">
            </div>
          </div>
        </div>
      </div>
      <div class="athlete">
        <img src="images/athlete1.jpeg" alt="Image of athlete">
        <a href="" class="modalBtn"><?php echo $lang['athlete5_name']; ?></a>
        <div class="athlete-modal">
          <div class="modal-content">
            <div class="modal-header">
              <span class="closeBtn">&times;</span>
              <h3><?php echo $lang['athlete5_name']; ?></h3>
            </div>
            <div class="modal-body">
              <p><?php echo $lang['athlete5_text']; ?></p>
              <img src="images/athlete1.jpeg" alt="Image of athlete">
            </div>
          </div>
        </div>
      </div>
      <div class="athlete">
        <img src="images/athlete3.jpg" alt="Image of athlete">
        <a href="" class="modalBtn"><?php echo $lang['athlete6_name']; ?></a>
        <div class="athlete-modal">
          <div class="modal-content">
            <div class="modal-header">
              <span class="closeBtn">&times;</span>
              <h3><?php echo $lang['athlete6_name']; ?></h3>
            </div>
            <div class="modal-body">
              <p><?php echo $lang['athlete6_text']; ?></p>
              <img src="images/athlete3.jpg" alt="Image of athlete">
            </div>
          </div>
        </div>
      </div>
      <div class="athlete">
        <img src="images/athlete2.jpeg" alt="Image of athlete">
        <a href="" class="modalBtn"><?php echo $lang['athlete7_name']; ?></a>
        <div class="athlete-modal">
          <div class="modal-content">
            <div class="modal-header">
              <span class="closeBtn">&times;</span>
              <h3><?php echo $lang['athlete7_name']; ?></h3>
            </div>
            <div class="modal-body">
              <p><?php echo $lang['athlete7_text']; ?></p>
              <img src="images/athlete2.jpeg" alt="Image of athlete">
            </div>
          </div>
        </div>
      </div>
      <div class="athlete">
        <img src="images/athlete1.jpeg" alt="Image of athlete">
        <a href="" class="modalBtn"><?php echo $lang['athlete8_name']; ?></a>
        <div class="athlete-modal">
          <div class="modal-content">
            <div class="modal-header">
              <span class="closeBtn">&times;</span>
              <h3><?php echo $lang['athlete8_name']; ?></h3>
            </div>
            <div class="modal-body">
              <p><?php echo $lang['athlete8_text']; ?></p>
              <img src="images/athlete1.jpeg" alt="Image of athlete">
            </div>
          </div>
        </div>
      </div>
      <div class="athlete">
        <img src="images/athlete3.jpg" alt="Image of athlete">
        <a href="" class="modalBtn"><?php echo $lang['athlete9_name']; ?></a>
        <div class="athlete-modal">
          <div class="modal-content">
            <div class="modal-header">
              <span class="closeBtn">&times;</span>
              <h3><?php echo $lang['athlete9_name']; ?></h3>
            </div>
            <div class="modal-body">
              <p><?php echo $lang['athlete9_text']; ?></p>
              <img src="images/athlete3.jpg" alt="Image of athlete">
            </div>
          </div>
        </div>
      </div>
      <div class="athlete">
        <img src="images/athlete2.jpeg" alt="Image of athlete">
        <a href="" class="modalBtn"><?php echo $lang['athlete10_name']; ?></a>
        <div class="athlete-modal">
          <div class="modal-content">
            <div class="modal-header">
              <span class="closeBtn">&times;</span>
              <h3><?php echo $lang['athlete10_name']; ?></h3>
            </div>
            <div class="modal-body">
              <p><?php echo $lang['athlete10_text']; ?></p>
              <img src="images/athlete2.jpeg" alt="Image of athlete">
            </div>
          </div>
        </div>
      </div>

  </div>
  </section>




</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->


<?php

} //end of if(submitted)

?>
