<?php # index.php

/*
 *  This is the main page.
 *  This page includes the configuration file,
 *  the templates, and any content-specific modules.
 */

// Require the configuration file before any PHP code:
require('./includes/php/config.inc.php');

// Validate what page to show:
if (isset($_GET['p'])) {
    $p = $_GET['p'];
} elseif (isset($_POST['p'])) { // Forms
    $p = $_POST['p'];
} else {
    $p = NULL;
}

// Determine what page to display:
switch ($p) {
  case 'programs':
    $page = 'programs.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Programs';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Programmes';
    }
    $page_class = 'programs';
    $page_css = 'includes/css/programs.css';
    $script = 'includes/js/programs-options.js';
    break;
  case 'programs_male':
    $page = 'programs_male.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Male Training Programs';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Programmes de Formation Pour Hommes';
    }
    $page_class = 'programs_male';
    $page_css = 'includes/css/programs_male.css';
    break;
  case 'programs_fem':
    $page = 'programs_fem.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Female Training Programs';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Programmes de Formation Pour Femmes';
    }
    $page_class = 'programs_fem';
    $page_css = 'includes/css/programs_fem.css';
    break;
  case 'priv_coach':
    $page = 'priv_coach.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Private Coaching';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Coaching Privé';
    }
    $page_class = 'priv_coach';
    $page_css = 'includes/css/priv_coach.css';
    break;
  case 'hock_train':
    $page = 'hock_train.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Hockey Training';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Entraînement de Hockey';
    }
    $page_class = 'hock_train';
    $page_css = 'includes/css/hock_train.css';
    break;
  case 'hock_train_inseason':
    $page = 'hock_train_inseason.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Hockey Training In-Season';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Entraînement de Hockey En Saison';
    }
    $page_class = 'hock_train_inseason';
    $page_css = 'includes/css/hock_train_season.css';
    $script = 'includes/js/hock_train-options.js';
    break;
  case 'hock_train_offseason':
    $page = 'hock_train_offseason.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Hockey Training Off-Season';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Entraînement de Hockey Hors Saison';
    }
    $page_class = 'hock_train_offseason';
    $page_css = 'includes/css/hock_train_season.css';
    $script = 'includes/js/hock_train-options.js';
    break;
  case 'hock_train_y':
    $page = 'hock_train_y.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Youth Hockey Training';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Entraînement de Hockey Pour les Jeunes';
    }
    $page_class = 'hock_train_y';
    $page_css = 'includes/css/hock_train_y.css';
    break;
  case 'hock_train_j':
    $page = 'hock_train_j.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Junior Hockey Training';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Entraînement de Hockey Junior';
    }
    $page_class = 'hock_train_j';
    $page_css = 'includes/css/hock_train_j.css';
    break;
  case 'hock_train_p':
    $page = 'hock_train_p.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Pro Hockey Training';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Entraînement de Hockey Professionnel';
    }
    $page_class = 'hock_train_p';
    $page_css = 'includes/css/hock_train_p.css';
    break;
  case 'blog':
    $page = 'blog.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Blog';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Blog';
    }
    $page_class = 'blog';
    $page_css = 'includes/css/blog.css';
    break;
  case 'blog_p':
    $page = 'blog_page.inc.php';
    if(isset($_GET['t'])) {
      $page_title = $_GET['t'];
    } else {
      if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
        $page_title = 'Blog Page';
      } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
        $page_title = 'Page de Blog';
      }
    };
    $page_class = 'blog-page';
    $page_css = 'includes/css/blog_page.css';
    $script = 'includes/js/favorite.js';
    break;
  case 'about':
    $page = 'about.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'About Us';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'À Propos de Nous';
    }
    $page_class = 'about';
    $page_css = 'includes/css/about.css';
    break;
  case 'contact':
    $page = 'contact.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Contact';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Contact';
    }
    $page_class = 'contact';
    break;
  case 't_and_c':
    $page = 't_and_c.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Terms & Conditions';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Termes et Conditions';
    }
    $page_class = 't_and_c';
    $page_css = 'includes/css/t_and_c.css';
    break;
  case 'login':
    $page = 'login-form.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Login';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'S\'identifier';
    }
    $page_class = 'login';
    $script = 'includes/js/login-form.js';
    break;
  case 'signup':
    $page = 'signup-form.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Sign Up';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'S\'inscrire';
    }
    $page_class = 'sign_up';
    $script = 'includes/js/signup-form.js';
    break;
  case 'change_p':
    $page = 'change_password.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Change Password';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Changer le Mot de Passe';
    }
    $page_class = 'change_p';
    break;
  case 'view_p':
    $page = 'view_your_purchases.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'View Your Purchases';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Voir Votre Achat';
    }
    $page_class = 'view_p';
    $page_css = 'includes/css/view_p.css';
    break;
  case 'logout':
    $page = 'logout.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Logout';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Connectez - Out';
    }
    $page_class = 'logout';
    $page_css = 'includes/css/logout.css';
    break;
  case 'forgot_p':
    $page = 'forgot_password.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Forgot Password';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Mot de Passe Oubié';
    }
    $page_class = 'forgot_p';
    break;
  case 'view_prod':
    $page = 'view_product.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'View Product';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Voir le Produit';
    }
    $page_class = 'view_prod';
    $page_css = 'includes/css/view_prod.css';
    break;
  case 'checkout':
    $page = 'checkout.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Checkout';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Check-out';
    }
    $page_class = 'checkout';
    $page_css = 'includes/css/checkout.css';
    $script = 'https://code.jquery.com/jquery-3.3.1.min.js';
    $script2 = 'https://js.stripe.com/v3/';
    $script3 = 'includes/js/charge.js';
    break;
  case 'success_transaction':
    $page = 'success.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Successful Purchase';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Achat Réussi';
    }
    $page_class = 'success';
    $page_css = 'includes/css/success-fail.css';
    break;
  case 'failed_transacation':
    $page = 'fail.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Unsuccessful Purchase';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Achat Infructueux';
    }
    $page_class = 'fail';
    $page_css = 'includes/css/success-fail.css';
    break;
  case 'view_p_content':
    $page = 'view_purchase_content.inc.php';
    if ($_SESSION['SD_Fitness_Sess']['lang'] == 'en') {
      $page_title = 'Purchase Content';
    } else if ($_SESSION['SD_Fitness_Sess']['lang'] == 'fr') {
      $page_title = 'Acheter du Contenu';
    }
    $page_class = 'view_p_content';
    $page_css = 'includes/css/view_p_content.css';
    break;


  // Default is to include the main page.
  default:
    $page = 'main.inc.php';
    $page_title = 'SD Fitness';
    $page_class = 'main';
    $page_css = 'includes/css/home.css';
    $script = 'includes/js/homepage-slideshow.js';
    $script2 = 'includes/js/modals.js';
    break;

} // End of main switch.

// Make sure the file exists:
if (!file_exists('./modules/' . $page)) {
    $page = 'main.inc.php';
    $page_title = 'SD Fitness';
    $page_css = 'includes/css/home.css';
    $script = 'includes/js/homepage-slideshow.js';
    $script2 = 'includes/js/modals.js';
}

// Include the header file:
include('./includes/php/header.inc.php');

// Include the content-specific module:
// $page is determined from the above switch.
include('./modules/' . $page);

// Include the footer file to complete the template:
include('./includes/php/footer.inc.php');

?>
