<?php # priv_coach.inc.php
/* this page is the private coaching content module (private training programs)
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

  <div class="pimg1-start">
      <h2>Private Training Programs</h2>
  </div>

  <section class="section section-opening">
    <h3>Avaliable Programs</h3>
    <div class="programs-wrapper">
      <?php //output the training programs avaliable
      //connect to db
      require(MYSQL);

      //make and run male programs query
      $q = 'SELECT p.id, p.title, p.short_description, p.img_file_name, pc.category FROM products as p
          INNER JOIN product_categories as pc
          ON p.category_id = pc.id
          WHERE p.gender = "all" AND p.age_group = "all"';
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
        echo '<p class="error">There are currently no male training programs.</p>';
      }
      ?>

    </div> <!-- end of programs-wrapper -->

    <!-- <h3>Avaliable Plans</h3>
    <div class="options-wrapper">
      <div class="option option1">
        <ul class="price-box">
          <li class="header">Simple</li>
          <li class="emph"><strong>$ 5.99</strong> / Month</li>
          <li>Basic Fitness Plan</li>
          <li><strong>1</strong> Hour of Consultation / Month</li>
          <li>-</li>
          <li>-</li>
          <li>-</li>
          <li class="emph"><a href="#" class="button">Sign Up</a></li>
        </ul>
      </div>
      <div class="option option2">
        <ul class="price-box">
          <li class="header">Standard</li>
          <li class="emph"><strong>$ 5.99</strong> / Month</li>
          <li>Basic Fitness Plan</li>
          <li>Basic Diet Plan</li>
          <li>Unlimited Access to Blog Content</li>
          <li><strong>4</strong> Hours of Consultation / Month</li>
          <li>-</li>
          <li class="emph"><a href="#" class="button">Sign Up</a></li>
        </ul>
      </div>
      <div class="option option3">
        <ul class="price-box">
          <li class="header">Super</li>
          <li class="emph"><strong>$ 5.99</strong> / Month</li>
          <li>Basic Fitness Plan</li>
          <li>Basic Diet Plan</li>
          <li>Unlimited Access to Blog Content</li>
          <li>Biometric Calculations</li>
          <li><strong>8</strong> Hours of Consultation / Month</li>
          <li class="emph"><a href="#" class="button">Sign Up</a></li>
        </ul>
      </div>
    </div> -->
  </section>

  <div class="pimg2">
    <div class="ptext">
      <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</p>
    </div>
  </div>

  <section class="section section-vid">

    <div class="box-a">
      <video src="images/bg_vid1.mov" autoplay loop></video>
    </div>
    <div class="box-b">
      <h3>Section Two</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius aliquam tenetur hic animi, asperiores tempora distinctio voluptates maiores, quis. Voluptatem laborum incidunt illum nihil tempora saepe aperiam a nostrum ad consectetur atque praesentium cumque rem ipsa, quisquam cupiditate quasi accusamus doloribus doloremque nesciunt ducimus eaque. Fugit obcaecati adipisci repudiandae ipsa blanditiis. Asperiores voluptas dignissimos quaerat voluptatum laboriosam delectus, animi quae corporis accusantium modi dicta, sed impedit. Laboriosam, sed eum minima repellat, tempore id neque, nisi consectetur eligendi at ipsa rem facilis, perferendis sequi.</p>
    </div>
  </section>

  <div class="pimg3">
    <div class="ptext">
      <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</p>
    </div>
  </div>

  <section class="section">
    <h3>Section Three</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius aliquam tenetur hic animi, asperiores tempora distinctio voluptates maiores, quis. Voluptatem laborum incidunt illum nihil tempora saepe aperiam a nostrum ad consectetur atque praesentium cumque rem ipsa, quisquam cupiditate quasi accusamus doloribus doloremque nesciunt ducimus eaque. Fugit obcaecati adipisci repudiandae ipsa blanditiis. Asperiores voluptas dignissimos quaerat voluptatum laboriosam delectus, animi quae corporis accusantium modi dicta, sed impedit. Laboriosam, sed eum minima repellat, tempore id neque, nisi consectetur eligendi at ipsa rem facilis, perferendis sequi.</p>
  </section>


  <div class="pimg1-end">
    <h2>"Inspirational quote"</h2>
  </div>



</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
