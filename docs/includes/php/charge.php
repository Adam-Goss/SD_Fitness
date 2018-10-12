<?php
//require stripe API php module (from composer)
require_once("../../vendor/autoload.php");
//require config file for DB
require_once('config.inc.php');

//check if the login form has been submitted (checking POST variable is set and hidden form
//field has been submitted
if( isset($_POST['submitted'])
  && (isset($_POST['pid']) && filter_var($_POST['pid'], FILTER_VALIDATE_INT, array('min_range' => 1)))
  && (isset($_POST['cid']) && filter_var($_POST['cid'], FILTER_VALIDATE_INT, array('min_range' => 1)))
  && (isset($_POST['n']) && (($_POST['n'] == 'yes') || ($_POST['n'] == 'no')))
) {

  //requie DB connection
  require(MYSQL);
  //sanitize POST variables and set
  $pid = $_POST['pid'];
  $cid = $_POST['cid'];
  $nutrition = $_POST['n'];
  $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
  $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
  $token = filter_var($_POST['stripeToken'], FILTER_SANITIZE_STRING);

  //check product id is valid and is in DB and get product info
  $q = 'SELECT id, title, volume, season, price FROM products WHERE id=' . $pid;
  $r = @mysqli_query($dbc, $q);

  if (mysqli_num_rows($r) !== 1) { // Problem!
    //redirect user to fail page
    $url = '../../' . 'index.php?p=failed_transacation';
    header("Location: $url");
	}
	// Fetch the product date
	$prodRow = mysqli_fetch_array($r, MYSQLI_ASSOC);



  //check user id is valid and matches info in DB
  $q = 'SELECT id FROM users WHERE id=' . $cid .
      ' AND ' . strtoupper('first_name') . '="' . strtoupper($first_name) .
      '" AND ' . strtoupper('last_name') . '="' . strtoupper($last_name) .
      '" AND email="' . $email .'"';
  $r = @mysqli_query($dbc, $q);

  if (mysqli_num_rows($r) !== 1) { // Problem!
    //redirect user to fail page
    $url = '../../' . 'index.php?p=failed_transacation';
    header("Location: $url");
	}
	// Fetch the product date
	$userRow = mysqli_fetch_array($r, MYSQLI_ASSOC);


  // create stripe object with api key (test)
  \Stripe\Stripe::setApiKey(STRIPE_TEST_API_KEY);
  //create customer in stripe
  $customer = \Stripe\Customer::create(array(
    "email" => $email,
    "description" => $first_name ." ". $last_name,
    "source" => $token
  ));
  //charge customer for product
  $charge = \Stripe\Charge::create(array(
    "amount" => $prodRow['price'] * 100,
    "currency" => "usd",
    "description" => $prodRow['title'] .", Vol: ". $prodRow['volume'] .", Season: ". $prodRow['season'],
    "customer" => $customer->id
  ));

  $charge_amount = $charge->amount / 100;

  //insert charge into transaction table (using prepared statement)
  $q = "INSERT INTO transactions (user_id, product_id, stripe_customer_id, stripe_transaction_id, payment_status, currency, payment_amount)
  VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($dbc, $q);
  mysqli_stmt_bind_param($stmt, 'iissssd', $userRow['id'], $prodRow['id'], $customer->id, $charge->id, $charge->status, $charge->currency, $charge_amount);
  mysqli_stmt_execute($stmt);
  // mysqli_stmt_execute($stmt);
  if (mysqli_stmt_affected_rows($stmt) !== 1) { //IF PROBLEM THEN REDIRECT
    //redirect user to fail page
    $url = '../../' . 'index.php?p=failed_transacation';
    header("Location: $url");
    // echo "error first query";
  }

  //if the user selected to by the nutrition option - charge customer for both options
  if($nutrition == 'yes') {
    //find price of nutrition option subtract from
    $q = 'SELECT id, title, price FROM products WHERE id = 27';
    $r = @mysqli_query($dbc, $q);
    if (mysqli_num_rows($r) !== 1) { // Problem!
      //redirect user to fail page
      $url = '../../' . 'index.php?p=failed_transacation';
      header("Location: $url");
    }
    $nutRow = mysqli_fetch_array($r, MYSQLI_ASSOC);

    //charge customer for nutrition option
    $charge2 = \Stripe\Charge::create(array(
      "amount" => $nutRow['price'] * 100,
      "currency" => "usd",
      "description" => $nutRow['title'],
      "customer" => $customer->id
    ));

    $charge2_amount = $charge2->amount / 100;
    //insert charge2 into transaction table (using prepared statement)
    $q = "INSERT INTO transactions (user_id, product_id, stripe_customer_id, stripe_transaction_id, payment_status, currency, payment_amount)
    VALUES (?,?,?,?,?,?,?)";
    $stmt = mysqli_prepare($dbc, $q);
    mysqli_stmt_bind_param($stmt, 'iissssd', $userRow['id'], $nutRow['id'], $customer->id, $charge2->id, $charge2->status, $charge2->currency, $charge2_amount);
    mysqli_stmt_execute($stmt);
    if (mysqli_stmt_affected_rows($stmt) !== 1) { //IF PROBLEM THEN REDIRECT
      //redirect user to fail page
      $url = '../../' . 'index.php?p=failed_transacation';
      header("Location: $url");
      // echo "error second query";
    }

    //redirect to success page
    $url = '../../' . 'index.php?p=success_transaction&tid='. urldecode($charge->id) .'&product='. urldecode($charge->description) .'&n=TRUE';
    header("Location: $url");
    exit();


  }


  //redirect to success page
  $url = '../../' . 'index.php?p=success_transaction&tid='. urldecode($charge->id) .'&product='. urldecode($charge->description);
  header("Location: $url");


} else { //page accessed in error (redirect)
  echo "ERROR";
}



 ?>
