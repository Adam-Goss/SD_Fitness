<?php # checkout.inc.php
/* this page is the checkout content module (buying product takes place)
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

//connet to db
require(MYSQL);

echo '<!-- start of page specific content -->
      <div class="inner-wrapper">';


//check if a POST request (and has the hidden field submitted)
if(isset($_POST['submitted'])) {

  //array for recording buying errors
  $buying_errors = array();

  //variable for price of product
  $price = 0.00;

  //validate product id (pid)
  if (isset($_POST['pid']) && filter_var($_POST['pid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {

    $pid = $_POST['pid'];

    //check if that produt id exists in the database
    $q = "SELECT id FROM products WHERE id = $pid";
    $r = mysqli_query($dbc, $q);

    if (mysqli_num_rows($r) !== 1) { // Problem!
      //product id is not in database
      $buying_errors['product'] = 'Please select a valid product';
    }

  } else {
    $buying_errors['product'] = 'Please select a valid product';
  }


  //validate the terms and conditions have been checked
  if( isset($_POST['t_and_c']) && ($_POST['t_and_c'] == 'yes') ) {
    //terms and conditions accepted

  } else {
    $buying_errors['t_and_c'] = 'Please read and accept terms and conditions to continue';
  }




  //validate the nutrition option
  if( isset($_POST['n']) && (($_POST['n'] == 'yes') || ($_POST['n'] == 'no'))) {
    $nutrition = $_POST['n'];

    //changing price if the 'yes' option was selected
    if ($nutrition == 'yes') {
      //get the price of the nutrition program and add to price
      $q2 = 'SELECT id, title, short_description, img_file_name, price FROM products
            WHERE id = 27';
    	$r2 = mysqli_query($dbc, $q2);
    	if (mysqli_num_rows($r2) !== 1) { // Problem!
    		echo '<div class="alert alert-danger">This page has been accessed in error.</div>';
        echo '</div>';
    		include('./includes/php/footer.php');
    		exit();
    	}

      $row2 = mysqli_fetch_array($r2, MYSQLI_ASSOC);
      $price += $row2['price'];
    }

  } else {
    $buying_errors['nutrition'] = 'Please select a valid nutrition option';
  }


  if (empty($buying_errors)) { //OK to proceed


    //check if the user is logged in (so they can purchase the product)
    if( isset($_SESSION['SD_Fitness_Sess']['user_id']) ) {

      $user_id = $_SESSION['SD_Fitness_Sess']['user_id'];

      //check if that user id exists in the database
      $q = "SELECT id FROM users WHERE id = $user_id";
      $r = mysqli_query($dbc, $q);

      if (mysqli_num_rows($r) !== 1) { // Problem!
        //user id is not in database
        echo '<p>Please <a href="index.php?p=logout">logout</a> and try again</p>';
        echo '</div>';
  		  include('./includes/php/footer.inc.php');
  		  exit();
      }



      //get the product info for final review
      $q = "SELECT id, gender, age_group, title, price FROM products WHERE id = $pid";
      $r = mysqli_query($dbc, $q);
    	if (mysqli_num_rows($r) !== 1) { // Problem!
        echo '<div class="alert alert-danger">This page has been accessed in error.</div>';
        echo '</div>';
		    include('./includes/php/footer.php');
		    exit();
	    }

      // Fetch the product info and display:
      $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

      //calculate the final price
      $price += $row['price'];

      //display product info and buying options
      echo "<h2>Your Order:</h2>";
      echo "<div class=\"buy_summary\">
              <div class=\"buy_table\">
                <table>
                  <tr>
                    <th>Program</th>
                    <th>Gender</th>
                    <th>Age Group</th>
                    <th>Nutrition Included</th>
                    <th>Price</th>
                  </tr>
                  <tr>
                    <td>{$row['title']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['age_group']}</td>
                    <td>$nutrition</td>
                    <td>$$price</td>
                  </tr>
                </table>
              </div>";


        echo "<div class=\"payment_options\">
                <h3>Buy Now:</h3>
                <a href=\"#\">STRIPE PAYMENT</a>
                <a href=\"#\">PAYPAL PAYMENT</a>
              </div>
              <a href=\"index.php?p=view_prod&pid={$row['id']}\">
              <div class=\"edit_order\">
                <h3>Edit Order</h3>
              </div>
              </a>
            </div>
            <div class=\"terms\">
              <p><a href=\"index.php?p=t_and_c\">Questions about your order?</a></p>
            </div>";


    } else { //user is not logged in
      echo '<p>You must <a href="index.php?p=login">login</a> or <a href="index.php?p=signup">sign up</a> to buy</p>';
    } //END OF user_id set (logged in) IF

  } else { //if the buying options form was invalid

    foreach($buying_errors as $error) {
      echo "<p class=\"login-error\">$error</p>";
    }
    echo "<p>Please try again</p>";

  } //END OF $buying_errors IF


} else { //invalid product id (pid)
	echo '<div class="alert alert-danger">This page has been accessed in error.</div>';
} //END OF pid validation PRIMARY IF




?>

</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
