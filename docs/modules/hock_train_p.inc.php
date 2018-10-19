<?php # hock_train_p.inc.php
/* this page is the hockey training pro content module (pro hockey
* training programs)
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

//check which season the program is for
if(isset($_GET['s'])) {
  //set season variable
  if($_GET['s'] == 'in') {

    $season = $lang['inseason'];
    $sql_season = 1;

  } elseif ($_GET['s'] == 'off') {

    $season = $lang['offseason'];
    $sql_season = 2;

  } else {
    //error so redirect to the index page:
    $url = BASE_URL . 'index.php';
    header ("Location: $url");
    exit;
  }

} else {
  //error so redirect to the index page:
  $url = BASE_URL . 'index.php';
  header ("Location: $url");
  exit;
}

?>
<!-- start of page specific content -->
<div class="inner-wrapper">

  <div class="showcase-img">
  <h2><?php echo $lang['pro'] .' '. $season .' '. $lang['training_programs']; ?></h2>
  </div>

  <div class="programs-wrapper">
    <?php //output the training programs avaliable
    //connect to db
    require(MYSQL);

    //make and run male programs query
    $q = 'SELECT id, title, short_description, img_file_name
          FROM products
          WHERE age_group = "junior" AND season = ' . $sql_season;
    $r = @mysqli_query($dbc, $q);

    //count the number of returned rows:
    $num = mysqli_num_rows($r);

    if($num > 0) { //query ran OK
      //fetch and print all the records
      while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo "<div class=\"program\">
                <div class=\"program-img\">
                  <img src=\"program_images/{$row['img_file_name']}\" alt=\"Program Image\">
                </div>
                <div class=\"program-content\">
                  <h3>{$row['title']}</h3>
                  <p>{$row['short_description']}</p>
                  <p><a href=\"index.php?p=view_prod&pid={$row['id']}\">View</a></p>
                </div>
             </div>";
      }

      //free up the resources
      mysqli_free_result($r);
      //close db connection
      mysqli_close($dbc);

    } else { //no records to return
      echo '<p class="error">' . $lang['no_pro_programs'] . '</p>';
    }
    ?>

  </div> <!-- end of programs-wrapper -->


</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
