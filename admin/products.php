<?php
include_once('includes/php/header.inc.php');

?>
<!-- start of main content  -->

    <!-- breadcrumb section -->
    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index.php">Dashboard</a></li>
          <li class="active">Products</li>
        </ol>
      </div>
    </section>
    <!-- END OF BREADCRUMB SECTION -->

    <!-- main section -->
    <section id="main">
      <div class="container">
        <div class="row">
          <!-- pages side bar -->
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.php" class="list-group-item main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge">33</span></a>
              <a href="products.php" class="list-group-item active"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> Products <span class="badge">203</span></a>
              <a href="blog_posts.php" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Blog Posts<span class="badge">12</span></a>
            </div>
            <div class="well">
              <h4>Disk Space Used</h4>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">60%</div>
              </div>
              <h4>Bandwidth Used </h4>
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">40%</div>
              </div>
            </div>
          </div>
          <!-- END OF PAGES SIDE BAR -->


          <!-- main pages section -->
          <div class="col-md-9">
            <!-- pages panel -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Products</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="Filter Pages...">
                  </div>
                  <br>
                  <table class="table table-striped table-hover">
                    <tr>
                      <th>Title</th>
                      <th>Published</th>
                      <th>Created</th>
                      <th></th>
                    </tr>
                    <tr>
                      <td>Home</td>
                      <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                      <td>Dec 12, 2016</td>
                      <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                    </tr>
                    <tr>
                      <td>About</td>
                      <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                      <td>Dec 13, 2016</td>
                      <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                    </tr>
                    <tr>
                      <td>Services</td>
                      <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                      <td>Dec 13, 2016</td>
                      <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                    </tr>
                    <tr>
                      <td>Contact</td>
                      <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                      <td>Dec 14, 2016</td>
                      <td><a class="btn btn-default" href="edit.php">Edit</a> <a class="btn btn-danger" href="#">Delete</a></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <!-- END OF PAGES PANEL  -->


         </div>
         <!-- END OF MAIN PAGES SECTION -->
        </div>
      </div>
    </section>
    <!-- END OF MAIN SECTION -->

<?php
  include_once('./includes/php/modals.inc.php');
  include_once('./includes/php/footer.inc.php');
?>
