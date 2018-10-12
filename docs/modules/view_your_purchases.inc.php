<?php # blog.inc.php
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


//check the user is logged in
if(isset($_SESSION['SD_Fitness_Sess']['username'])) {
  //need DB connection
  require(MYSQL);

  $user_id = $_SESSION['SD_Fitness_Sess']['user_id'];
  $username = $_SESSION['SD_Fitness_Sess']['username'];

} else {
  //if user is not logged in (has session w/ username) then send them to login form
  header('Location: index.php?p=login');
} ?>
<!-- start of page specific content -->
<div class="inner-wrapper">
  <h2>Hi, <?php echo $username //print user's username ?></h2>

<?php
//check if the user has made any purchases (has any orders)
$q = 'SELECT * FROM transactions WHERE user_id=' . $user_id;
$r = @mysqli_query($dbc,$q);

if(mysqli_num_rows($r) > 0) {
  //if the customer has made purchases
  echo '<h2>you currently have purchased ...</h2><div class="purchases_container">';

  //join the transactions table to the products table to get product info
  $q = 'SELECT t.product_id, p.title, p.volume, p.season, p.short_description, p.img_file_name FROM transactions as t
        INNER JOIN products as p ON t.product_id = p.id
        WHERE t.user_id=' . $user_id;
  $r = @mysqli_query($dbc,$q);

  //fetch and display purchases
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
    echo "<div class=\"purchase-box\">
            <div class=\"purchase-img\">
              <img src=\"program_images/{$row['img_file_name']}\" alt=\"purchase image\">
            </div>
            <div class=\"purchase-content\">
              <h3>{$row['title']} | Volume: {$row['volume']} | Season: {$row['season']}</h3>
              <p>{$row['short_description']}</p>
              <p><a href=\"#\">View Purchase</a></p>
            </div>
          </div>";
  }

  //close purchases_container div
  echo "\n</div>";
  //free up the resources
  mysqli_free_result($r);
  //close db connection
  mysqli_close($dbc);


} else {
  //the customer has no purchases
  echo '<h2>you currently have no purchases</h2>';
}

?>

</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
