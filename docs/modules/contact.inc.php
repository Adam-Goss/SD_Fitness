<?php # contact.inc.php
/* this page is the contact content module (contact form and contact info)
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
  <!-- <h2>Contact SD Fitness</h2> -->

  <div class="form-wrapper">
    <div class="contact-info">
      <img src="images/generic-logo.png">
      <ul>
        <li><i class="fa fa-road"></i>123 Smith St.</li>
        <li>Doverfield, ON<br>O3B 2T5</li>
        <li><i class="fa fa-phone"></i>002-998-1123</li>
        <li><i class="fa fa-envelope"></i>test@acme.test</li>
      </ul>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>

    <div class="contact">
      <h3>Email Us</h3>
      <form action="#">
        <p>
          <label for="name">Name:</label>
          <input type="text" name="name">
        </p>
        <p>
          <label for="company">Company:</label>
          <input type="text" name="company">
        </p>
        <p>
          <label for="email">Email:</label>
          <input type="email" name="email">
        </p>
        <p>
          <label for="phone">Phone Number:</label>
          <input type="text" name="phone">
        </p>
        <p class="full">
          <label for="message">Message:</label>
          <textarea name="message" rows="5"></textarea>
        </p>
        <p class="full">
          <button>Submit</button>
        </p>
        </form>
    </div>
  </div>



</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
