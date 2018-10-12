<?php # about.inc.php
/* this page is the about content module (info about company)
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

if (!empty($_GET['tid'] && !empty($_GET['product']))) {
  $GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);

  $tid = $GET['tid'];
  $product = $GET['product'];

} else {
  //redirect
  header('Location: index.php');
}
?>

<!-- start of page specific content -->
<div class="inner-wrapper">

  <div class="success-container">
    <h2>Thank you for purchasing:
      <?php echo "<br><span class=\"product-title\">$product</span>"; ?></h2>
    <?php
    if(isset($_GET['n']) && ($_GET['n'] == 'TRUE')) {
      echo '<h3>(And the nutrition option!)</h3>';
    }
    ?>
    <hr>
    <p>Your transaction ID is <?php echo $tid; ?></p>
    <p>Check your email for more information</p>
    <p><a href="index.php?p=view_p">View Purchases</a></p>
  </div>


</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
