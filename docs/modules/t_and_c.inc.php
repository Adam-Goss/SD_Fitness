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

    <h2>Terms & Conditions</h2>
    <p>These products are not intended to diagnose, treat, cure or prevent any disease. Product results may vary from person to person.</p>


    <div class="returnsGuranteesFAQs">
      <h3>Returns, Guarantees & FAQs</h3>
        <ul>
          <li><h4>Is There A Money Back Guarantee on SD Fitness Programs?</h4>
            <ul>
              <li>SD Fitness offers a 14-day (2 weeks) refund policy from the date of purchase on digital AND on hard copies of programs.</li>
              <li>In order to protect ourselves from abuse we reserve the right to refuse refunds to people that we deem to be 'serial refunders'. Those include people that have received one or more refunds in the past. If you have received a refund in the past you are not eligible for refunds on future courses without express, written permission in advance from SD Fitness.</li>
            </ul>
          </li>
          <li><h4>How Long Will It Take To Receive My Order?</h4>
            <ul>
              <li>Most orders ship within 1 business day.  Once it has shipped, USPS or Fedex will generally deliver within 3 to 5 business days to any US or Canadian address.</li>
              <li>International orders via DHL Express generally arrive in 3 to 5 business days depending on the country they are shipped to.</li>
            </ul>
          </li>
          <li><h4>How Do I Track My Order?</h4>
            <ul>
              <li>When your order ships you will receive an email with the tracking number.  You can track in real time at (insert Wesbite URL for tracking here)</li>
            </ul>
          </li>
          <li><h4>My Order Says It Was Delivered But I've Not Received Anything</h4>
            <ul>
              <li>USPS or Fedex will sometimes mark something as delivered before it was actually dropped off.  If this is the case give it 2 more business days.  If you've not received it by then please call us or email us at (Insert Website support email link)</li>
            </ul>
          </li>
          <li><h4>Why Can't You Ship To My Country?</h4>
            <ul>
              <li>Certain countries are embargoed or restricted by the US & Canadian Government.</li>
            </ul>
          </li>
          <li><h4>Why Is International Shipping So Expensive?</h4>
            <ul>
              <li>Unfortunately, shipping internationally can be expensive. We only use DHL Express to ensure speedy delivery with end-to-end tracking and the fewest importing hassles possible.</li>
              <li>Due to our shipping volumes we get a very large discount that we pass along to you.</li>
            </ul>
          </li>
          <li><h4>Will I Have To Pay Import Taxes or Duties?</h4>
            <ul>
              <li>It depends.  Some countries are more comprehensive when it comes to collecting duties. Please be prepared as these are your responsibility if they are levied.</li>
            </ul>
          </li>
          <li><h4>Will Your Products Clear Customs?</h4>
            <ul>
              <li>Remember, you are responsible for what you import so please be sure to check it in advance.</li>
            </ul>
          </li>
          <li><h4>I Ordered a SD Fitness Program But I've Not Received It Yet</h4>
            <ul>
              <li>All SD Fitness programs are delivered digitally (unless hard copy was purchased) at( Insert Website link to products). Depending on how you purchased you might need to reset your password.</li>
              <li>This is a complete list of the digital and hard copy list of SD Fitness products (Insert link of products here)</li>
              <li>If you continue to have login issues please contact support (Support email).</li>
            </ul>
          </li>
        </ul>
    </div> <!-- end of returnsGuranteesFAQs div -->

    <div class="orderTerms">
      <h3>Order Terms</h3>
        <p>By placing your order you agree to, comply with, and accept the following conditions:</p>
        <ul>
          <li>You are 18 years or older, or have explicit permission to purchase if under the age of 18.</li>
          <li>Our Money Back Guarantee as outlined here: (Insert Returns, refund policy FAQs page here)</li>
          <li>Our International Shipping as outlined here: (Insert link to international tracking of product here)</li>
        </ul>
        <p>Please note: Order processing during and around Holiday times may be delayed due to volume</p>
    </div> <!-- end of orderTerms div -->

    <div class="fullTermsConditions">
      <p>View Full <a href="website_terms_conditions.pdf" target="_blank">Website Terms & Conditions</a></p>
    </div>

  </div> <!-- end of termsAndConditionsWrapper -->








</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
