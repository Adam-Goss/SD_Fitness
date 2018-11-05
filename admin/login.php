<?php
include_once('includes/php/header.inc.php');

?>
<!-- start of main content  -->



    <!-- main section -->
    <section id="main">
      <div class="container">
        <div class="row">
          <!-- main login form section -->
          <div class="col-md-4 col-md-offset-4">
            <form action="#" id="login" class="well">
              <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" placeholder="Enter Email">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" placeholder="Enter Password">
              </div>
              <button class="btn btn-default btn-block" type="submit">Login</button>
            </form>
         </div>
         <!-- END OF MAIN LOGIN FORM SECTION -->
        </div>
      </div>
    </section>
    <!-- END OF MAIN SECTION -->

<?php
  include_once('./includes/php/footer.inc.php');
?>
