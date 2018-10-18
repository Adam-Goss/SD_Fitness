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
      echo "<li><a href=\"index.php?p=logout\">{$lang['logout']}</a></li>
            <li>|</li>
            <li><a href=\"index.php?p=change_p\">{$lang['change_password']}</a></li>
            <li>|</li>
            <li><a href=\"index.php?p=view_p\">{$lang['view_your_purchases']}</a></li>";
    } else {
      echo "<li><a href=\"index.php?p=login\">{$lang['login']}</a></li>
            <li>|</li>
            <li><a href=\"index.php?p=signup\">{$lang['sign_up']}</a></li>";
    }
    ?>
    <li><?php echo $lang['language']; ?></li>
    <li>
      <a href="<?php
      if (!empty($_SERVER['QUERY_STRING'])) {
        echo htmlentities($_SERVER['REQUEST_URI']) . "&lang=en";
      } else {
        echo htmlentities($_SERVER['PHP_SELF']) . "?lang=en";
      }
      ?>">ENG</a>
    </li>
    <li>|</li>
    <li>
      <a href="<?php
      if (!empty($_SERVER['QUERY_STRING'])) {
        echo htmlentities($_SERVER['REQUEST_URI']) . "&lang=fr";
      } else {
        echo htmlentities($_SERVER['PHP_SELF']) . "?lang=fr";
      }
      ?>">FRA</a>
    </li>
  </ul>
</div>


<div class="logo"><a href="index.php"><img src="images/generic-logo.png" width="100%" /></a></div> <!-- logo -->


  <header>
    <!-- navigation -->
    <nav class="main-nav">
      <ul>
        <li class="dropdown"><a class="programsLink" href="index.php?p=programs"><?php echo $lang['programs']; ?></a>
          <div class="dropdown-content">
            <a class="programs_maleLink" href="index.php?p=programs_male"><?php echo $lang['male']; ?></a>
            <a class="programs_femLink" href="index.php?p=programs_fem"><?php echo $lang['female']; ?></a>
          </div>
        </li>
        <li><a class="priv_coachLink" href="index.php?p=priv_coach"><?php echo $lang['private_coaching']; ?></a></li>
        <li class="dropdown"><a class="hock_trainLink" href="index.php?p=hock_train"><?php echo $lang['hockey_training']; ?></a>
          <div class="dropdown-content">
            <a class="hock_train_inLink" href="index.php?p=hock_train_inseason"><?php echo $lang['in-season']; ?></a>
            <a class="hock_train_offLink" href="index.php?p=hock_train_offseason"><?php echo $lang['off-season']; ?></a>
          </div>
        </li>
        <li><a class="blogLink" href="index.php?p=blog"><?php echo $lang['blog']; ?></a></li>
        <li><a class="aboutLink" href="index.php?p=about"><?php echo $lang['about_us']; ?></a></li>
      </ul>
    </nav>
  </header>
<!-- end of header -->
