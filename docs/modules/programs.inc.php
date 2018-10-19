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
      <h3><?php echo $lang['male']; ?></h3>
      <a href="index.php?p=programs_male" class="btn"><?php echo $lang['read_more']; ?></a>
    </div>
    <div class="split right">
      <h3><?php echo $lang['female']; ?></h3>
      <a href="index.php?p=programs_fem" class="btn"><?php echo $lang['read_more']; ?></a>
    </div>
  </div>

  <div class="info">
    <div class="content-img">
      <img src="images/shredded_male.jpeg" alt="">
    </div>
    <div class="content-box1">
      <h2><?php echo $lang['getfit_programs']; ?></h2>
      <p><?php echo $lang['getfit_programs_info']; ?></p>
    </div>
    <div class="content-box2">
      <h2><?php echo $lang['getshredded_programs']; ?></h2>
      <p><?php echo $lang['getshredded_programs_info']; ?></p>
    </div>
    <div class="content-img">
      <img src="images/shredded_female.jpeg" alt="">
    </div>
    <div class="content-img">
      <img src="images/general_male.jpeg" alt="">
    </div>
    <div class="content-box3">
      <h2><?php echo $lang['get_bfs_programs']; ?></h2>
      <p><?php echo $lang['get_bfs_programs_info']; ?></p>
    </div>

  </div>

  <div class="training-quote">
    <!-- <img src="images/quote_img.jpg" alt=""> -->
    <p><?php echo $lang['inspirational_quote6']; ?></p>
  </div>




</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
