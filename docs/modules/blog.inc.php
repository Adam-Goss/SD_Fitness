<?php # blog.inc.php
/* this page is the blog content module (blogs)
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


//if a search is made
if (isset($_POST['submitted'])) {
	//handle the search

	// Check for a search term:
	if (empty($_POST['search'])) {

		//redirect to general blog page if no term given
		$url = 'index.php?p=blog';
		header("Location: $url");
		exit();

	} else {
		$term = escape_data($_POST['search'], $dbc);
	}


	if (isset($term)) {

		//query
    $q = "SELECT id, title, description, img_file_name FROM blogs
          WHERE title LIKE '%".$term."%' OR description LIKE '%".$term."%'";
    $r = @mysqli_query($dbc, $q);
    $snum = mysqli_num_rows($r);

    if ($snum > 0) { //ran OK, display results
      ?>
      <!-- start of page specific content -->
      <div class="inner-wrapper">

        <!-- <h2>SD Fitness Blog</h2> -->


        <div class="filter-bar">
          <ul>
            <li><a href="index.php?p=blog&sort=dc">Most Recent</a></li>
            <li>|</li>
            <li><a href="index.php?p=blog&sort=v">Most Popular</a></li>
            <li>|</li>
            <?php // COMBAK: ADD FUNCTIONALITY FOR HIGHEST RATED BLOG PAGES USING blog_page_ratings table ?>
            <li><a href="index.php?p=blog&sort=hr">Highest Rated</a></li>
            <li>|</li>
            <li><a href="index.php?p=blog&cat=h">Hockey</a></li>
            <li>|</li>
            <li><a href="index.php?p=blog&cat=n">Nutrition</a></li>
            <li>|</li>
            <li><a href="index.php?p=blog&cat=f">Fitness</a></li>
            <li>|</li>
            <li><a href="index.php?p=blog&cat=st">Sports Training</a></li>
            <li>|</li>
            <li><a href="index.php?p=blog&cat=l">Lifestyle</a></li>
            <li>|</li>
            <li><a href="index.php?p=blog&cat=o">Other Articles</a></li>
            <li><form class="" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?p=blog" method="post" role="search">
              <input type="text" name="search" id="search-box" placeholder="<?php echo $term; ?>">
              <input type="hidden" name="submitted" value="TRUE">
            </form></li>
          </ul>
        </div>

      <?php
        echo '<div class="blog-posts">';

       	//fetch and print all the records
      	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
      		echo "<div class=\"post\">
            <ul>
              <li>
                <img src=\"blog_images/{$row['img_file_name']}\" alt=\"blog image\">
              </li>
              <li><h3>{$row['title']}</h3></li>
              <li><p>{$row['description']}</p></li>
              <li class=\"btn\">
                <a href=\"index.php?p=blog_p&id={$row['id']}&t=", urlencode($row['title']), "\">Read More</a>
              </li>
            </ul>
          </div>";
      	}

        echo "\n</div>"; //close blog-posts class

      	//free up the resources
      	mysqli_free_result($r);

      	//close db connection
      	mysqli_close($dbc);

    } else { //no results

      echo "<p>Your search did not match any products. Please try again.</p>";

    } //end of IF search results

  } // end of IF search term validation

} else {

  //number of pages to display
  $display = 6;

  // Determine how many pages there are...
  if (isset($_GET['n']) && is_numeric($_GET['n'])) { // Already been determined.

    $pages = $_GET['n'];

  } else { // Need to determine.
    // Count the number of records:
  	$q = "SELECT COUNT(id) FROM blogs";
  	$r = @mysqli_query ($dbc, $q);
  	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
  	$records = $row[0];

  	// Calculate the number of pages...
  	if ($records > $display) {    // More than 1 page.
  		$pages = ceil($records/$display);
  	} else {
  		$pages = 1;
  	}
  } // END   (isset($_GET['p'])   IF.

  // Determine where in the database to start returning results...
  if (isset($_GET['s']) && is_numeric($_GET['s'])) {
    $start = $_GET['s'];
  } else {
  	$start = 0;
  }

  // Determine the sort...
  // Default is by blog id.
  $sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'bi';

  // Determine the sorting order:
  switch ($sort) {
  	case 'bt':
  		$order_by = 'b.title ASC';      //not currently used in sort bar (could add in)
  		break;
  	case 'dc':
  		$order_by = 'b.date_created DESC';
  		break;
  	case 'v':
  		$order_by = 'b.views DESC';
  		break;
    case 'hr':
  		$order_by = 'rating_sum DESC';
  		break;
  	case 'bi':
  		$order_by = 'id ASC';
  		break;
    default:
  		$order_by = 'id ASC';
  		$sort = 'bi';
  		break;
  }

  //determine the category (default is all)
  $cat = (isset($_GET['cat'])) ? $_GET['cat'] : 'all';

  // Determine the category:
  switch ($cat) {
  	case 'all':
  		$show = '>= 1';      //not currently used in sort bar (could add in)
  		break;
  	case 'h':
  		$show = '= 1';
  		break;
  	case 'n':
  		$show = '= 2';
  		break;
  	case 'f':
  		$show = '= 3';
  		break;
  	case 'st':
  		$show = '= 4';
  		break;
  	case 'l':
  		$show = '= 5';
  		break;
  	case 'o':
  		$show = '= 6';
  		break;
    default:
  		$show = '>= 1';
  		$cat = 'all';
  		break;
  }


  //make and run blog records query on the db
  $q = "SELECT b.id, b.title, b.description, b.img_file_name, SUM(bpr.rating) AS rating_sum FROM blogs as b
        INNER JOIN blog_page_ratings as bpr
        ON b.id = bpr.blog_id
        WHERE b.blog_category_id $show
        GROUP BY b.id
        ORDER BY $order_by
        LIMIT $start, $display";
  $r = @mysqli_query($dbc, $q);

  //count the number of returned rows:
  $num = mysqli_num_rows($r);


  //make and run blog categories query on the db
  $q2 = "SELECT id, category FROM blog_categories";
  $r2 = @mysqli_query($dbc, $q2);




  //display sort bars
  ?>
  <!-- start of page specific content -->
  <div class="inner-wrapper">

  <!-- <?php echo $records; ?> -->
    <!-- <h2>SD Fitness Blog</h2> -->

    <div class="filter-bar">
      <ul>
        <li><a href="index.php?p=blog&sort=dc">Most Recent</a></li>
        <li>|</li>
        <li><a href="index.php?p=blog&sort=v">Most Popular</a></li>
        <li>|</li>
        <?php // COMBAK: ADD FUNCTIONALITY FOR HIGHEST RATED BLOG PAGES USING blog_page_ratings table ?>
        <li><a href="index.php?p=blog&sort=hr">Highest Rated</a></li>
        <li>|</li>
        <li class="dropdown">Sort by category
          <div class="dropdown-content">
            <ul>
              <li><a href="index.php?p=blog&cat=h">Hockey</a></li>
              <li><a href="index.php?p=blog&cat=n">Nutrition</a></li>
              <li><a href="index.php?p=blog&cat=f">Fitness</a></li>
              <li><a href="index.php?p=blog&cat=st">Sports Training</a></li>
              <li><a href="index.php?p=blog&cat=l">Lifestyle</a></li>
              <li><a href="index.php?p=blog&cat=o">Other Articles</a></li>
            </ul>
          </div>
        </li>
      </ul>
      <form class="" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?p=blog" method="post" role="search">
        <input type="text" name="search" id="search-box" placeholder="Search ...">
        <input type="hidden" name="submitted" value="TRUE">
      </form>
    </div>

  <?php

  if ($num > 0) {
  	//if the query ran OK, display the records

    echo '<div class="blog-posts">';

   	//fetch and print all the records
  	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
  		echo "<div class=\"post\">
            <ul>
              <li>
                <img src=\"blog_images/{$row['img_file_name']}\" alt=\"blog image\">
              </li>
              <li><h3>{$row['title']}</h3></li>
              <li><p>{$row['description']}</p></li>
              <li class=\"btn\">
                <a href=\"index.php?p=blog_p&id={$row['id']}&t=", urlencode($row['title']), "\">Read More</a>
              </li>
            </ul>
          </div>";
  	}

    echo "\n</div>"; //close blog-posts class

  	//free up the resources
  	mysqli_free_result($r);

  	//close db connection
  	mysqli_close($dbc);

  	// Make the links to other pages, if necessary.
  	if ($pages > 1) {

  		// Add some spacing and start a paragraph:
  		echo "\n<div class=\"page_count\"><p>";
  		// Determine what page the script is on:
  		$current_page = ($start/$display) + 1;

  		// If it's not the first page, make a Previous link:
  		if ($current_page != 1) {
  			echo '<a href="index.php?p=blog&amp;s=' . ($start - $display) .
  			'&amp;n=' . $pages . '&amp;sort=' . $sort . '&amp;cat=' . $cat .'">Previous</a> &nbsp;';
  		}

  		// Make all the numbered pages:
  		for ($i = 1; $i <= $pages; $i++) {
  			if ($i != $current_page) {
  				echo '&nbsp; <a href="index.php?p=blog&amp;s=' . (($display * ($i - 1))) .
  				'&amp;n=' . $pages . '&amp;sort=' . $sort . '&amp;cat=' . $cat .'">' . $i . '</a> &nbsp;';
  			} else {
  				echo '&nbsp;  ' . $i . ' ';
  			}

  		} // End of FOR loop.

  		// If it's not the last page, make a Next button:
  		if ($current_page != $pages) {
  			echo '&nbsp; <a href="index.php?p=blog&amp;s=' . ($start + $display) .
  			'&amp;n=' . $pages . '&amp;sort=' . $sort . '&amp;cat=' . $cat .'">Next</a>';
  		}

  		echo '</p></div>'; // Close the paragraph

  	} // End of if($pages)  links section.


  } else {
  	//if no records were returned:
  	echo '<p class="error">There are currently no blog posts.</p>';
  	/*
  	//if the query did not run OK
  	//public message:
  	echo '<p class="error">The current users could not be retrieved. We apologize for any inconvience.</p>';
  	//debugging message:
  	echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';
  	 */

  } //END of if($r) IF


} // end of IF post submitted conditional
?>

</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
