<?php # hock_train.inc.php
/* this page is the main hockey training content module (general hockey
* training programs for inseason and offseason)
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

  <div class="season-wrapper">
    <div class="description-box">
      <p><?php echo $lang['hockey_training_description']; ?></p>
    </div>
    <div class="inseason-box">
      <h3><?php echo $lang['inseason_training']; ?></h3>
      <a href="index.php?p=hock_train_inseason" class="btn"><?php echo $lang['read_more']; ?></a>
    </div>
    <div class="offseason-box">
      <h3><?php echo $lang['offseason_training']; ?></h3>
      <a href="index.php?p=hock_train_offseason" class="btn"><?php echo $lang['read_more']; ?></a>
    </div>
  </div>


  <!-- <div class="training-quote"> -->
    <!-- <img src="images/quote_img.jpg" alt=""> -->
    <!-- <p>"Inspirational Quote"</p> -->
  <!-- </div> -->



</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
