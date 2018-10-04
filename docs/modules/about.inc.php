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
      <h2>BIO: Sean DeVarnnes, CSCS</h2>
      <p>Founder/Owner of SD Fitness.</p>
    </section>

    <section class="bioContent">
      <p>Sean DeVarennes is a member of the National Strength and Conditioning Association (NSCA), and a Certified Strength and Conditioning Specialist (CSCS).</p>
      <p>Graduating in the recent Spring of 2018 at Mercyhurst University with a bachelor’s degree in Exercise Science and minors in Public Health and Psychology, Sean has an insatiable passion to aid athletes of all ages and sports to become professionals and elite athletes and is also striving to help anyone wishing to achieve their ultimate fitness goals besides sports.</p>
      <p>Among the accomplishments of receiving his bachelor’s degree, Sean was the Head Chairmen of the Exercise Science curriculum at Mercyhurst University’s Sports Medicine department. Sean was also the Head Strength and Conditioning Coach of the ACHA DI Men’s Ice hockey program his senior year and has since fellow teammates excel in their hockey careers in college and in professional leagues.</p>
      <p> In addition to all these achievements, Sean was also the head supervisor of Mercyhurst’s Recreational training facility for 2 years in which he delegated work stations and responsibilities of maintaining and cleaning of the facility to work study students, and provided training programs, injury rehabilitation and injury prevention consultations to fellow non-athletic students and faculty members.</p>
      <p>In relation to his hockey and exercise science career, Sean has been an ice hockey player since he was 7 years old. As many Canadians living in Moncton New Brunswick, one of the many hockey hotbeds in eastern Canada, Sean wants to achieve his dreams in pursuing professional hockey in the hopes of one day, he would play in the NHL. With a burning desire to continue to improve his game day in and day out, Sean has been through countless hockey trainers in his youth and teen years, traveling around North America since he was 17, and has had unbelievable experiences not just hockey wise, but in the world of exercise science as well.</p>
      <p>During his time at Mercyhurst University, Sean played for the Mercyhurst Laker’s ACHA Division I hockey program. Along with his hockey experiences in college, Sean had amazing opportunities in observing some of North America’s best hockey trainers, including his internships with the Erie Otters of the OHL, the Division I NCAA team at Mercyhurst along with its Division II Football team, East Coast Ice Performance trainers from New Brunswick Canada, to UPMC Lemieux Ice complex, the official practice facility of the Pittsburgh Penguins.</p>
      <p>From these experiences Sean has had close mentorship from guys such as Gary Roberts, former NHL Veteran and now one of the top hockey training Guru’s of North America, in which he has his own hockey training facility in Ontario, Canada. Gary Roberts was also the co-founder of Gary Roberts High Performance Training ™, which led to Sean’s many one-on-one experiences with elite athletes ranging from U16AAA hockey players, to high level Division I NCAA athletes as well as ECHL, and AHL players. With invaluable personal experiences gained from these experiences, Sean has used every bit of knowledge from his experiences to give himself the edge to play professionally.</p>
      <p>Since graduating, Sean will be embarking his first year of Professional Ice hockey here in the United States. As he pursues his goals to become the best that he can be, he also wants to show an example not only to hockey athletes, but anyone who wants to get to the next level, whether its getting healthier, improve their performance, or reach their ultimate goals.</p>
    </section>

    <section class="bioVideo">
        <h3>My Story</h3>
        <video src="images/bg_vid1.mov" autoplay loop></video>
    </section>




    <h2 class="testimonialsTitle">What People Are Saying</h2>

    <section class="bioTestimonialVideos">

      <div class="testimonial-box">
        <div class="testimonialContent">
          <h4>Ryan Rebman</h4>
          <p>College Hockey Player</p>
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
          <h4>Adam Goss</h4>
          <p>Pro Hockey Player</p>
        </div>
      </div>

      <div class="testimonial-box">
        <div class="testimonialContent">
          <h4>Shannon English</h4>
          <p>Fitness Enthusiast</p>
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
          <h4>Gary Scott</h4>
          <p>College Hockey Player</p>
        </div>
      </div>

    </section> <!-- end of bioTestimonialVideos section -->

    <div class="training-quote">
      <!-- <img src="images/quote_img.jpg" alt=""> -->
      <p>"Inspirational Quote"</p>
    </div>


  </div> <!-- end of aboutUsWrapper -->


</div> <!-- end of inner-wrapper -->
<!-- end of page specific content -->
