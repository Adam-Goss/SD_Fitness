<?php # view_product.inc.php
/* this page is the view product content module (product info)
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

//connect to db
require(MYSQL);

//validate product id (pid)
if (isset($_GET['pid']) && filter_var($_GET['pid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {

  $pid = $_GET['pid'];

  //get product info
  $q = 'SELECT p.id, p.title, p.long_description, p.img_file_name, p.price, pc.category FROM products as p
        INNER JOIN product_categories as pc
        ON p.category_id = pc.id
        WHERE p.id = ' . $pid;
	$r = mysqli_query($dbc, $q);
	if (mysqli_num_rows($r) !== 1) { // Problem!
    echo '<div class="inner-wrapper">';
		echo '<div class="alert alert-danger">This page has been accessed in error.</div>';
    echo '</div>';
		include('./includes/php/footer.php');
		exit();
	}

  // Fetch the product info and display:
  $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

  echo '<!-- start of page specific content -->
        <div class="inner-wrapper">';

  // TODO: STYLING
  echo "<div class=\"product\">
          <div class=\"product_header\">
            <div class=\"program-img\" style=\"background: url('program_images/{$row['img_file_name']}');\">
            </div>
            <h3>{$row['title']}</h3>
          </div>
          <div class=\"product_info\">
            {$row['long_description']}
          </div>";

  echo '<div class="buying_info">';

  //check if the user is logged in (so they can purchase the product)
  if( isset($_SESSION['SD_Fitness_Sess']['user_id']) ) {

    $user_id = $_SESSION['SD_Fitness_Sess']['user_id'];

    //get nutrition program
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

    //show buying information
    // TODO: STYLING
    echo "<form class=\"buy_options_form\" action=\"index.php?p=checkout\" method=\"post\" accept-charset=\"utf-8\">
            <fieldset>
              <div class=\"form-group1\">
                <select name=\"pid\">
                  <option value=\"{$row['id']}\" selected>{$row['title']}</option>
                </select>
              </div>
              <div class=\"form-group2\">
                <p>I agree to terms and conditions</p>
                <input type=\"radio\" name=\"t_and_c\" value=\"yes\" required> Yes
                <p><a href=\"website_terms_conditions.pdf\" target=\"_blank\">*View terms and conditions</a></p>
              </div>
              <div class=\"form-group3\">
                <p>Include {$row2['title']}?</p>
                <input type=\"radio\" name=\"n\" value=\"yes\" checked> Yes (\${$row2['price']})
                <input type=\"radio\" name=\"n\" value=\"no\"> No
                <div class=\"nutrition-program\">
                  <div class=\"pn-img\">
                    <img src=\"program_images/{$row2['img_file_name']}\">
                  </div>
                  <div class=\"pn-short-des\">
                    {$row2['short_description']}
                    <p><a href=\"\">Find out more</a></p>
                  </div>
                </div>
              </div>
              <button type=\"submit\" class=\"\">Buy</button>
            </fieldset>
            <input type=\"hidden\" name=\"submitted\" value=\"TRUE\">
          </form>";

  } else { //user not logged in

    //say user must log in to buy product
    // TODO: STYLING
    echo '<p>You must <a href="index.php?p=login">login</a> or <a href="index.php?p=signup">sign up</a> to buy</p>';

  } //end of IF session set

  echo '</div>'; //close buying options div
  echo '</div>'; //close product div


} else { //invalid product id (pid)

  echo '<div class="inner-wrapper">';
	echo '<div class="alert alert-danger">This page has been accessed in error.</div>';

} // End of primary validation IF.


?>

</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->