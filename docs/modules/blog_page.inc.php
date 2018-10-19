<?php # blog_page.inc.php
/* this page is the specific blog page module (user selected)
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


// Validate the blog page ID:
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))) {

	$blog_id = $_GET['id'];
  $title = urldecode($_GET['t']);

	// Get the page info:
	$q = 'SELECT blog_category_id, title, description, content, img_file_name, date_created, views FROM blogs WHERE id=' . $blog_id;
	$r = mysqli_query($dbc, $q);
	if (mysqli_num_rows($r) !== 1) { // Problem!
		$page_title = 'Error!';
    echo '<div class="inner-wrapper">';
		echo '<div class="alert alert-danger">' . $lang['page_accessed_in_error'] . '</div>';
    echo '</div>';
		include('./includes/php/footer.php');
		exit();
	}


	// Fetch the blog page info and display:
	$row = mysqli_fetch_array($r, MYSQLI_ASSOC);

  //convert date_created into php DateTime object to and format
  $dc = new DateTime($row['date_created']);
  $dc_formatted = $dc->format('d M Y');

  //print blog page
  echo "<div class=\"inner-wrapper\">
          <div class=\"blog-page-wrapper\">
            <div class=\"blog-page-img\">
              <img src=\"blog_images/{$row['img_file_name']}\" alt=\"blog image\">
            </div>
            <div class=\"blog-page-header\">
	            <h2>$title</h2>
              <p>{$row['description']}</p>
              <p>$dc_formatted</p>
            </div>
            <div class=\"blog-page-content\">{$row['content']}</div>
          </div>
    ";

  //update the number of views on the blog
  $blog_views = (int) $row['views'];
  // COMBAK: FIX UPDATING BLOG VIEWS BY 1
  $q = 'UPDATE blogs SET views = ' . ($blog_views + 1) . ' WHERE id = ' . $blog_id;
	$r = mysqli_query($dbc, $q);
	if (!$r) { // Problem!
		$page_title = 'Error!';
		echo '<div class="alert alert-danger">' . $lang['no_update_blog_views'] . '</div>';
    echo '</div>';
		include('./includes/php/footer.php');
		exit();
	}


  //if users is logged in then add blog page to their history (to show on their homepage)
  if( isset($_SESSION['SD_Fitness_Sess']['user_id']) ) {

	  $user_id = $_SESSION['SD_Fitness_Sess']['user_id'];

  	// Record this visit to the blog history table:
  	$q = 'INSERT INTO blog_history (user_id, blog_category_id, blog_id) VALUES (?,?,?)';
    $stmt = mysqli_prepare($dbc, $q);
    mysqli_stmt_bind_param($stmt, 'iii', $user_id, $row['blog_category_id'], $blog_id);
    mysqli_stmt_execute($stmt);
    // if (mysqli_stmt_affected_rows($stmt) > 0) { //everything OK
  	// 	echo "<div>Okay</div>";
  	// } else {
  	// 	echo "<div>NOT Okay</div>";
  	// 	trigger_error();
  	// }

    // Create add to favorites and remove from favorites links:
    // See if this is favorite:
    $q = 'SELECT user_id FROM favorite_blog_pages WHERE user_id=' . $user_id . ' AND blog_id=' . $blog_id;
    $r = mysqli_query($dbc, $q);
    echo '<div class="favorite-box">';
    if (mysqli_num_rows($r) === 1) {
      echo '<h3 id="favorite_h3"><i class="far fa-thumbs-up"></i><span>' . $lang['a_favorite'] . '</span>
        <a id="remove_favorite_link" title="remove favorite" href="#"><i class="far fa-thumbs-down"></i></a>
        </h3>';
    } else {
      echo '<h3 id="favorite_h3"><span>' . $lang['make_favorite'] . '</span>
        <a id="add_favorite_link" title="favorite page" href="#"><i class="far fa-thumbs-up"></i></a>
        </h3>';
    }
    echo '</div>';



    // COMBAK: MAKE RATINGS STAR ICONS (FROM FONT AWESOME)

  	//check if the user has rated the page already
  	if (($_SERVER['REQUEST_METHOD'] === 'POST')) {

  		if (isset($_POST['rating']) && !empty($_POST['rating'])) {
  			//check rating is between 1 and 5
  			if (($_POST['rating'] >= 1) && ($_POST['rating'] <= 5)) {

  				$rating = $_POST['rating'];
  				$q = 'REPLACE INTO blog_page_ratings (user_id, blog_id, rating) VALUES (?,?,?)';
          $stmt = mysqli_prepare($dbc, $q);
          mysqli_stmt_bind_param($stmt, 'iii', $user_id, $blog_id, $rating);
          mysqli_stmt_execute($stmt);

          if (mysqli_stmt_affected_rows($stmt) > 0) { //everything OK
  				      echo '<div class="alert alert-success">' . $lang['rating_saved'] . '</div>';
  				}
  			}
  		}
  	}

  	// Get the existing rating, if any:
  	if (!isset($rating)) {
  		$q = "SELECT rating FROM blog_page_ratings WHERE user_id=$user_id AND blog_id=$blog_id";
  		$r = mysqli_query($dbc, $q);
  		if (mysqli_num_rows($r) === 1) {
  			list($rating) = mysqli_fetch_array($r, MYSQLI_NUM);
  		}
  	}



  	//create a drop down
    echo '<div class="rating-box">';
  	echo '<form id="rating_form" action="' . htmlentities($_SERVER['PHP_SELF']) . '?p=blog_p&id=' . $blog_id . '&t=' . $title .'" method="post" accept-charset="utf-8">
  	<select name="rating" class="form-control">
    <option>' . $lang['select_one'] . '</option>';
  	//loop through possible ratings
  	for ($i=1; $i <= 5; $i++) {
  		echo "<option value=\"$i\" ";
  		//check if current user rating for page
  		if (isset($rating) && ($rating == $i)) echo 'selected="selected"';
  		echo ">$i / 5</option>";
  	}
  	echo '</select>
  	<input type="submit" name="submit_button" value="Rate!" id="submit_button" class="btn btn-default"/>
  	</form>';
    echo '</div>';


	} else { // Not logged in.
	   echo '<div class="alert">
          <p>' . $lang['not_logged_in'] . '</p>
          <p>' . $lang['login_signup_to_rate_favorite'] . '</p>
          </div>';
          exit();
	}


} else { // No valid ID.
  echo '<div class="inner-wrapper">';
	echo '<div class="alert alert-danger">' . $lang['page_accessed_in_error'] . '</div>';
} // End of primary IF.

//close the inner wrapper (page content) and add-in JS script variables
if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
  $form_language = 'en';
} else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
  $form_language = 'fr';
};
echo '<script type="text/javascript">
  var blog_id = ' . $blog_id . ';
  var user_id = ' . $user_id .';
  var form_language = "' . $form_language . '";
  </script></div>';
?>
