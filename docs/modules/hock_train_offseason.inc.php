<?php # hock_train_offseason.inc.php
/* this page is the main hockey training offseason content module (general hockey
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

?>
<!-- start of page specific content -->
<div class="inner-wrapper">

  <div class="options-wrapper">
    <div class="split left">
      <h3>Youth</h3>
      <a href="index.php?p=hock_train_y&s=off" class="btn">Read More</a>
    </div>
    <div class="split middle">
      <h3>Junior</h3>
      <a href="index.php?p=hock_train_j&s=off" class="btn">Read More</a>
    </div>
    <div class="split right">
      <h3>Pro</h3>
      <a href="index.php?p=hock_train_p&s=off" class="btn">Read More</a>
    </div>
  </div>

  <div class="info-offseason">
    <p>Every summer, hockey players everywhere engage in off-ice hockey training to get themselves better for the next season. Some players are looking to perform better than their previous season, some are getting ready to jump to the next level, and others are simply putting in the work to move up on their current team.</p>
    <p>One of the biggest challenges I faced when I grew up and trained hard for the next season, was that while I met many good trainers, A LOT of them were not making specialized training programs for me. While the training was still good (at a hefty price), much of the time I was in a group, which makes it harder to target the areas of my game that I want to improve on.</p>
    <p>Now that I am my own trainer, I have the advantage to create a program meant explicitly for my position in hockey. And I want to give you the same tools and programs that I, along with many of my other hockey clients, am using today.</p>
    <p>Whether you are a forward, defensemen or goalie, I have the right program just for you. Unlike many hockey/sports training program nowadays, I SPECIALIZE my programs for your position, so that not only are you keeping up with your performances on a consistent basis, you are working SPECIFICALLY on your game.</p>
    <p>The Program includes;</p>
    <ul>
      <li>Sports Specific Exercises</li>
      <li>Proper Warm-up Protocols with mobility exercises</li>
      <li>Cooldowns to ensure less soreness and more flexibility the next day</li>
      <li>Your own personalized workout schedule calendar</li>
      <li>How to progress properly to maximize benefits</li>
      <li>Exclusive Core Exercise list</li>
      <li>Expert Sports Nutrition package</li>
      <li>1 RM Percentage charts to help prevent overtiredness and overtraining</li>
      <li>Tapering methods to keep you fresh for every game, every practice</li>
      <li>And much more!</li>
    </ul>
    <p>As I specialize in elite high performance sports training, these programs come with three volumes at one price. We all know how long a hockey season can last, therefore I devised 2 training blocks that all have volume I to Volume III.</p>
    <p>If you are interested in taking your hockey to the next level, select your age group <a href="options-wrapper">above</a></p>

  </div>

  <div class="training-quote">
    <!-- <img src="images/quote_img.jpg" alt=""> -->
    <p>"Inspirational Quote"</p>
  </div>



</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
