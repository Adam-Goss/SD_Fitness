<?php # hock_train_inseason.inc.php
/* this page is the main hockey training inseason content module (general hockey
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
      <a href="index.php?p=hock_train_y&s=in" class="btn">Read More</a>
    </div>
    <div class="split middle">
      <h3>Junior</h3>
      <a href="index.php?p=hock_train_j&s=in" class="btn">Read More</a>
    </div>
    <div class="split right">
      <h3>Pro</h3>
      <a href="index.php?p=hock_train_p&s=in" class="btn">Read More</a>
    </div>
  </div>

  <div class="info-inseason">
    <p>In-season training is quite crucial in today’s fast paced hockey world. You want to keep on track with consistently performing at your best, yet sometimes it may feel like you’re “overtired”, causing some lapses in focus and ultimately causing you to underperform. Or, maybe you want to continue to improve on the small things your position on the team demands of you.</p>
    <p>I know I have. With countless years of doing in-season training, I’ve encountered these problems NUMEROUS times. This is where my In-season Elite Hockey Performance program kicks in;</p>
    <p>I have taken everything I have learned from not just learning the sport and studying the sports performance world, but from playing the sport. In fact, I am STILL using this knowledge today to propel myself higher in pro hockey, and it has given me and my clients remarkable results.</p>
    <p>Whether you are a forward, defensemen or goalie, I have the right program just for you. Unlike many hockey/sports training program nowadays, I SPECIALIZE my programs for your position, so that not only are you keeping up with your performances on a consistent basis, you are working SPECIFICALLY on your game.</p>
    <p>The Program includes;</p>
    <ul>
      <li>Top programs that are backed by science and high level hockey experiences</li>
      <li>Free Weight, Machine and Bodyweight exercises</li>
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
    <p>If you are interested in taking your hockey to the next level, select your age group <a href="options-wrapper">above</a>.</p>

  </div>

  <div class="training-quote">
    <!-- <img src="images/quote_img.jpg" alt=""> -->
    <p>"Inspirational Quote"</p>
  </div>



</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
