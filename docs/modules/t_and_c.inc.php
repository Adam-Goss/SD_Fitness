<?php # t_and_c.inc.php
/* this page is the terms and conditions content module (outlines terms and
* conditions for company)
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

  <div class="termsAndConditionsWrapper">

    <h2><?php echo $lang['t_and_c_title']; ?></h2>
    <p><?php echo $lang['disclaimer_msg']; ?></p>


    <div class="returnsGuranteesFAQs">
      <?php echo $lang['returns_guarantees_FAQs_info']; ?>
    </div> <!-- end of returnsGuranteesFAQs div -->

    <div class="orderTerms">
      <h3><?php echo $lang['order_terms_title']; ?></h3>
      <?php echo $lang['order_terms_info']; ?>
    </div> <!-- end of orderTerms div -->

    <div class="fullTermsConditions">
      <?php echo $lang['full_terms_conditions_link']; ?>
    </div>

  </div> <!-- end of termsAndConditionsWrapper -->








</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
