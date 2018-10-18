<?php # about.inc.php
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

?>
<!-- start of page specific content -->
<div class="inner-wrapper">

  <div class="aboutUsWrapper">

    <section class="bioTitle">
      <h2><?php echo $lang['bio_title_name']; ?></h2>
      <p><?php echo $lang['bio_title_description']; ?></p>
    </section>

    <section class="bioContent">
      <?php echo $lang['bio_content']; ?>
    </section>

    <section class="bioVideo">
        <h3><?php echo $lang['my_story']; ?></h3>
        <video src="images/bg_vid1.mov" autoplay loop></video>
    </section>




    <h2 class="testimonialsTitle"><?php echo $lang['what_people_are_saying']; ?></h2>

    <section class="bioTestimonialVideos">

      <div class="testimonial-box">
        <div class="testimonialContent">
          <h4><?php echo $lang['testimonial_athlete1_name']; ?></h4>
          <p><?php echo $lang['testimonial_athlete1_title']; ?></p>
        </div>
        <div class="testimonial-video">
          <video class="right-vid" src="videos/Rebman_testimonial_vid1.mp4"></video>
          <!-- <video src="images/rebmanTestimonialVideo.mov"></video> -->
        </div>
      </div>

      <div class="testimonial-box">
        <div class="testimonial-video">
          <video class="left-vid" src="images/bg_vid1.mov"></video>
          <!-- <video src="images/gossTestimonialVideo.mov"></video> -->
        </div>
        <div class="testimonialContent">
          <h4><?php echo $lang['testimonial_athlete2_name']; ?></h4>
          <p><?php echo $lang['testimonial_athlete2_title']; ?></p>
        </div>
      </div>

      <div class="testimonial-box">
        <div class="testimonialContent">
          <h4><?php echo $lang['testimonial_athlete3_name']; ?></h4>
          <p><?php echo $lang['testimonial_athlete3_title']; ?></p>
        </div>
        <div class="testimonial-video">
          <video class="right-vid" src="images/bg_vid1.mov"></video>
          <!-- <video src="images/englishTestimonialVideo.mov"></video> -->
        </div>
      </div>

      <div class="testimonial-box">
        <div class="testimonial-video">
          <video class="left-vid" src="images/bg_vid1.mov"></video>
          <!-- <video src="images/scottTestimonialVideo.mov"></video> -->
        </div>
        <div class="testimonialContent">
          <h4><?php echo $lang['testimonial_athlete4_name']; ?></h4>
          <p><?php echo $lang['testimonial_athlete4_title']; ?></p>
        </div>
      </div>

    </section> <!-- end of bioTestimonialVideos section -->

    <div class="training-quote">
      <!-- <img src="images/quote_img.jpg" alt=""> -->
      <p><?php echo $lang['inspirational_quote1']; ?></p>
    </div>


  </div> <!-- end of aboutUsWrapper -->


</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
