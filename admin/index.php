<?php
include_once('includes/php/header.inc.php');

?>
<!-- start of main content  -->

<!-- breadcrumb section -->
<section id="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <li class="active">Dashboard</li>
    </ol>
  </div>
</section>
<!-- END OF BREADCRUMB SECTION -->

<!-- main section -->
<section id="main">
  <div class="container">
    <div class="row">
      <!-- dashboard side bar -->
      <div class="col-md-3">
        <div class="list-group">
          <a href="index.php" class="list-group-item active main-color-bg">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
          </a>
          <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users <span class="badge">33</span></a>
          <a href="products.php" class="list-group-item"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> Products <span class="badge">203</span></a>
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
      <!-- END OF DASHBOARD SIDE BAR -->


      <!-- main dashboard section -->
      <div class="col-md-9">
        <!-- Website Overview panel -->
        <div class="panel panel-default">
          <div class="panel-heading main-color-bg">
            <h3 class="panel-title">Website Overview</h3>
          </div>
          <div class="panel-body">
            <div class="col-md-3">
              <div class="well dash-box">
                <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 203</h2>
                <h4>Users</h4>
              </div>
            </div>
            <div class="col-md-3">
              <div class="well dash-box">
                <h2><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> 12</h2>
                <h4>Products</h4>
              </div>
            </div>
            <div class="col-md-3">
              <div class="well dash-box">
                <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 33</h2>
                <h4>Blog Posts</h4>
              </div>
            </div>
            <div class="col-md-3">
              <div class="well dash-box">
                <h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> 12,334</h2>
                <h4>Visitors</h4>
              </div>
            </div>
          </div>
        </div>
        <!-- END OF WEBSITE OVERVIEW PANEL  -->

        <!-- latest users panel -->
        <div class="panel panel-default">
          <div class="panel-heading main-color-bg">
            <h3 class="panel-title">Latest Users</h3>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-hover">
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Joined</th>
              </tr>
              <tr>
                <td>Jill Smith</td>
                <td>jillsmith@gmail.com</td>
                <td>Dec 12, 2016</td>
              </tr>
              <tr>
                <td>Eve Jackson</td>
                <td>ejackson@yahoo.com</td>
                <td>Dec 13, 2016</td>
              </tr>
              <tr>
                <td>John Doe</td>
                <td>jdoe@gmail.com</td>
                <td>Dec 13, 2016</td>
              </tr>
              <tr>
                <td>Stephanie Landon</td>
                <td>landon@yahoo.com</td>
                <td>Dec 14, 2016</td>
              </tr>
              <tr>
                <td>Mike Johnson</td>
                <td>mjohnson@gmail.com</td>
                <td>Dec 15, 2016</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- END OF LATEST USERS PANEL -->
     </div>
     <!-- END OF MAIN DASHBOARD SECTION -->
    </div>
  </div>
</section>
<!-- END OF MAIN SECTION -->

<?php
include_once('./includes/php/modals.inc.php');
include_once('./includes/php/footer.inc.php');
?>
