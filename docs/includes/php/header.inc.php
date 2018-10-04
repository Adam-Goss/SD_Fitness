<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <?php // DEBUG: DOWNLOAD ICONS TO USE THEN INCLUDE STYLESHEET ?>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">


  <link rel="stylesheet" href="includes/css/main.css">

  <?php if(isset($page_css)) { echo "<link rel=\"stylesheet\" href=\"$page_css\">"; } ?>

  <title>
    <?php //use a default title page if one wasn't provided
    if (isset($page_title)) {
      echo $page_title;
	   } else {
			echo 'SD Fitness';
	   }
    ?>
    </title>
</head>
<body class="<?php if (isset($page_class)) { echo $page_class; }?>">


<div class="outer-wrapper">

<div class="top-nav">
  <ul class="social-links">
    <li><a href="#"><i class="fab fa-instagram fa-2x"></i></a></li>
    <li><a href="#"><i class="fab fa-twitter fa-2x"></i></a></li>
    <li><a href="#"><i class="fab fa-facebook fa-2x"></i></a></li>
  </ul>
  <ul class="other-links">
    <?php
    if(isset($_SESSION['SD_Fitness_Sess']['user_id'])) {
      echo '<li><a href="index.php?p=logout">Logout</a></li>
            <li>|</li>
            <li><a href="index.php?p=change_p">Change Password</a></li>
            <li>|</li>
            <li><a href="index.php?p=view_p">View Your Purchases</a></li>';
    } else {
      echo '<li><a href="index.php?p=login">Login</a></li>
            <li>|</li>
            <li><a href="index.php?p=signup">Sign Up</a></li>';
    }
    ?>
  </ul>
</div>


<div class="logo"><a href="index.php"><img src="images/generic-logo.png" width="100%" /></a></div> <!-- logo -->


  <header>
    <!-- navigation -->
    <nav class="main-nav">
      <ul>
        <li class="dropdown"><a class="programsLink" href="index.php?p=programs">Programs</a>
          <div class="dropdown-content">
            <a class="programs_maleLink" href="index.php?p=programs_male">Male</a>
            <a class="programs_femLink" href="index.php?p=programs_fem">Female</a>
          </div>
        </li>
        <li><a class="priv_coachLink" href="index.php?p=priv_coach">Private Coaching</a></li>
        <li class="dropdown"><a class="hock_trainLink" href="index.php?p=hock_train">Hockey Training</a>
          <div class="dropdown-content">
            <a class="hock_train_inLink" href="index.php?p=hock_train_inseason">In-Season</a>
            <a class="hock_train_offLink" href="index.php?p=hock_train_offseason">Off-Season</a>
          </div>
        </li>
        <li><a class="blogLink" href="index.php?p=blog">Blog</a></li>
        <li><a class="aboutLink" href="index.php?p=about">About Us</a></li>
      </ul>
    </nav>
  </header>
<!-- end of header -->
