<?php # logout.inc.php
/* this page is the logout content module (destroys the session)
* this page is included by index.php
*/

//config file already includeds by index.php for BASE_URL and redirect_invalid_user function


// Redirect if this page was accessed directly:
//(check if a constant is defined - if not redirect
if (!defined('BASE_URL')) {

    // Redirect to the index page:
    $url = BASE_URL . 'index.php';
    header ("Location: $url");
    exit;

} // End of defined() IF.

// If the user isn't logged in, redirect them:
redirect_invalid_user();

// Destroy the session:
$_SESSION['SD_Fitness_Sess'] = array(); // Destroy the variables.
session_destroy(); // Destroy the session itself.
setcookie (session_name('SD_Fitness_Sess'), '', time()-300); // Destroy the cookie.

?>
<!-- start of page specific content -->
<div class="inner-wrapper">

  <h2><?php echo $lang['logged_out']; ?></h2>
  <p><?php echo $lang['thankyou_msg']; ?></p>
  <i class="far fa-hand-peace fa-4x"></i>


  <?php
  //redirect user to main/home page
  $url = 'index.php';
  header("refresh:5; url=$url");
  ?>




</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
