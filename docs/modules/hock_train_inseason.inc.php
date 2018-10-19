<?php # hock_train_inseason.inc.php
/* this page is the main hockey training inseason content module (general hockey
* training programs)
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
      <h3><?php echo $lang['youth']; ?></h3>
      <a href="index.php?p=hock_train_y&s=in" class="btn"><?php echo $lang['read_more']; ?></a>
    </div>
    <div class="split middle">
      <h3><?php echo $lang['junior']; ?></h3>
      <a href="index.php?p=hock_train_j&s=in" class="btn"><?php echo $lang['read_more']; ?></a>
    </div>
    <div class="split right">
      <h3><?php echo $lang['pro']; ?></h3>
      <a href="index.php?p=hock_train_p&s=in" class="btn"><?php echo $lang['read_more']; ?></a>
    </div>
  </div>

  <div class="info-inseason">
    <?php echo $lang['inseason_info']; ?>
  </div>

  <div class="training-quote">
    <!-- <img src="images/quote_img.jpg" alt=""> -->
    <p><?php echo $lang['inspirational_quote3']; ?></p>
  </div>



</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
