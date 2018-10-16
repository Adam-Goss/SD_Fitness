<?php # fail.inc.php
/* this page is the failed transaction content module (shown if transaction fails)
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


?>

<!-- start of page specific content -->
<div class="inner-wrapper">

  <div class="fail-container">
    <h2>Your purchased could not be processed at this time</h2>
    <hr>
    <p><a href="index.php">Please Try Again</a></p>
  </div>


</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
