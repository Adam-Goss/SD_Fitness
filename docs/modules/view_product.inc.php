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
		echo '<div class="alert alert-danger">' . $lang['page_accessed_in_error'] . '</div>';
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

    //check if the user already has purchased the nutrition option
    $q3 = 'SELECT * FROM transactions WHERE user_id = ' . $user_id . ' AND
    product_id = 27';
  	$r3 = mysqli_query($dbc, $q3);
  	if (mysqli_num_rows($r3) < 1) {
      //if they haven't alreay purchased then show nutrition option to buy

      //get nutrition program
      $q2 = 'SELECT id, title, short_description, img_file_name, price FROM products
            WHERE id = 27';
    	$r2 = mysqli_query($dbc, $q2);
    	if (mysqli_num_rows($r2) !== 1) { // Problem!
    		echo '<div class="alert alert-danger">' . $lang['page_accessed_in_error'] . '</div>';
        echo '</div>';
    		include('./includes/php/footer.php');
    		exit();
    	}

      $row2 = mysqli_fetch_array($r2, MYSQLI_ASSOC);

      //show buying information if they haven't alreay brought nutrition program
      echo "<form class=\"buy_options_form\" action=\"index.php?p=checkout\" method=\"post\" accept-charset=\"utf-8\">
              <fieldset>
                <div class=\"form-group1\">
                  <select name=\"pid\">
                    <option value=\"{$row['id']}\" selected>{$row['title']}</option>
                  </select>
                </div>
                <div class=\"form-group2\">
                  <p>{$lang['agree_to_t_and_c']}</p>
                  <input type=\"radio\" name=\"t_and_c\" value=\"yes\" required> {$lang['yes']}
                  <p><a href=\"website_terms_conditions.pdf\" target=\"_blank\">*{$lang['view_t_and_c']}</a></p>
                </div>
                <div class=\"form-group3\">
                  <p>Include {$row2['title']}?</p>
                  <input type=\"radio\" name=\"n\" value=\"yes\" checked> {$lang['yes']} (\${$row2['price']})
                  <input type=\"radio\" name=\"n\" value=\"no\"> {$lang['no']}
                  <div class=\"nutrition-program\">
                    <div class=\"pn-img\">
                      <img src=\"program_images/{$row2['img_file_name']}\">
                    </div>
                    <div class=\"pn-short-des\">
                      {$row2['short_description']}
                      <p><a href=\"\">{$lang['find_out_more']}</a></p>
                    </div>
                  </div>
                </div>
                <button type=\"submit\" class=\"\">{$lang['buy']}</button>
              </fieldset>
              <input type=\"hidden\" name=\"submitted\" value=\"TRUE\">
            </form>";

        } else {
          //show buying information if they HAVE alreay brought nutrition program
          echo "<form class=\"buy_options_form\" action=\"index.php?p=checkout\" method=\"post\" accept-charset=\"utf-8\">
                  <fieldset>
                    <div class=\"form-group1\">
                      <select name=\"pid\">
                        <option value=\"{$row['id']}\" selected>{$row['title']}</option>
                      </select>
                    </div>
                    <div class=\"form-group2\">
                      <p>{$lang['agree_to_t_and_c']}</p>
                      <input type=\"radio\" name=\"t_and_c\" value=\"yes\" required> Yes
                      <p><a href=\"website_terms_conditions.pdf\" target=\"_blank\">*{$lang['view_t_and_c']}</a></p>
                    </div>
                    <div class=\"form-group3\">
                      <p>{$lang['previously_purchased_nutrition_option']} <a href=\"index.php?=view_p\">{$lang['view_purchases_homepage']}</a></p>
                      <input type=\"hidden\" name=\"n\" value=\"no\">
                    </div>
                    <button type=\"submit\" class=\"\">{$lang['buy']}</button>
                  </fieldset>
                  <input type=\"hidden\" name=\"submitted\" value=\"TRUE\">
                </form>";
        }

      } else { //user not logged in#

    //say user must log in to buy product
    echo '<p>' . $lang['login_signup_to_buy'] . '</p>';

  } //end of IF session set

  echo '</div>'; //close buying options div
  echo '</div>'; //close product div


} else { //invalid product id (pid)

  echo '<div class="inner-wrapper">';
	echo '<div class="alert alert-danger">' . $lang['page_accessed_in_error'] . '</div>';

} // End of primary validation IF.


?>

</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
