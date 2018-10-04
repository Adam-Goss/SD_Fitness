<?php # login-form.inc.php
/* this page is the main login form for the site
* (allows users to login to access content)
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

  <div id="form-container">
    <h1 class="logo">Login Form</h1>

    <div id="form-box">
      <i id="prev-btn" class="fas fa-arrow-left"></i>
      <i id="next-btn" class="fas fa-arrow-right"></i>

      <div id="input-group">
        <input id="input-field" required>
        <label id="input-label"></label>
        <div id="input-progress"></div>
        <div id="progress-bar"></div>
      </div>

    </div>

    <p class="help-block"><a href="index.php?p=forgot_p">Forgot Password?</a></p>
  </div>



</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
