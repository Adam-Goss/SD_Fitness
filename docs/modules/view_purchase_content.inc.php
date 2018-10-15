<?php # view_purchase_content.inc.php
/* this page is the view purchase content module (product info)
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
  $q = 'SELECT title, volume, season, content FROM products WHERE id = ' . $pid;
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

  echo "<div class=\"product\">
          <div class=\"product_title\">
            <h3>{$row['title']}</h3>
            <h4>Volume: {$row['volume']} - Season: {$row['season']}</h4>
          </div>
          <div class=\"product_content\">
            {$row['content']}
          </div>";

  echo '</div>'; //close product div


} else { //invalid product id (pid)

  echo '<div class="inner-wrapper">';
	echo '<div class="alert alert-danger">This page has been accessed in error.</div>';

} // End of primary validation IF.


?>

</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
