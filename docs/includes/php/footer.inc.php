<!-- footer -->
<footer>
  <div class="footer-wrapper">
  <div class="company-info">
    <h4><?php echo $lang['who_we_are']; ?></h4>
    <ul>
      <li><a class="aboutBottomLink" href="index.php?p=about"><?php echo $lang['about_us']; ?></a></li>
      <li><a class="contactLink" href="index.php?p=contact"><?php echo $lang['contact']; ?></a></li>
      <li><a class="t_and_cLink" href="index.php?p=t_and_c"><?php echo $lang['terms_and_conditions']; ?></a></li>
    </ul>
  </div>
  <div class="social-links">
    <a href="index.php"><img src="images/generic-logo.png" width="100%" /></a>
    <ul>
      <li><a href="#"><i class="fab fa-instagram fa-3x"></i></a></li>
      <li><a href="#"><i class="fab fa-twitter fa-3x"></i></a></li>
      <li><a href="#"><i class="fab fa-facebook fa-3x"></i></a></li>
    </ul>
  </div>
  <div class="contact">
    <h4><?php echo $lang['inqueries']; ?></h4>
    <ul>
      <li><i class="fa fa-envelope"></i> <a href="mailto:company@gmail.com">company@gmail.com</a></li>
      <li><i class="fa fa-phone"></i> 002-998-1123</li>
      <li><span>123 Smith St.<br>Doverfield, ON<br>O3B 2T5</span></li>
    </ul>
  </div>
  <div class="associates">
    <h4><?php echo $lang['proud_partner_with']; ?></h4>
    <img src="images/associate_logo.png" />
  </div>
  </div>
  <p>© 2018 SD Fitness. <span><?php echo $lang['all_rights_reserved']; ?></span></p>
</footer>

</div> <!-- end of outer-wrapper -->

<!-- scripts to be included -->
<?php
if (isset($script)) {
  echo "<script src=\"$script\"></script>\n";
  if (isset($script2)) {
    echo "<script src=\"$script2\"></script>\n";
    if (isset($script3)) {
      echo "<script src=\"$script3\"></script>\n";
    }
  }
}
?>

</body>
</html>
