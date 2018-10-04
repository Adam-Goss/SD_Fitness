<?php # programs.inc.php
/* this page is the general training program content module (general training programs)
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

  <div class="options-wrapper">
    <div class="split left">
      <h3>Male</h3>
      <a href="index.php?p=programs_male" class="btn">Read More</a>
    </div>
    <div class="split right">
      <h3>Female</h3>
      <a href="index.php?p=programs_fem" class="btn">Read More</a>
    </div>
  </div>

  <div class="info">
    <div class="content-img">
      <img src="images/shredded_male.jpeg" alt="">
    </div>
    <div class="content-box1">
      <h2>GetFit Programs</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
    <div class="content-box2">
      <h2>GetShredded Programs</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div class="content-img">
      <img src="images/shredded_female.jpeg" alt="">
    </div>
    <div class="content-img">
      <img src="images/general_male.jpeg" alt="">
    </div>
    <div class="content-box3">
      <h2>Get Bigger, Faster, & Stronger Programs</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>

  </div>

  <div class="training-quote">
    <!-- <img src="images/quote_img.jpg" alt=""> -->
    <p>"Inspirational Quote"</p>
  </div>




</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
