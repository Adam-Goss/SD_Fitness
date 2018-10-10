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
) {

  //requie DB connection
  require(MYSQL);
  //sanitize POST variables and set
  $pid = $_POST['pid'];
  $cid = $_POST['cid'];
  $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
  $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
  $token = filter_var($_POST['stripeToken'], FILTER_SANITIZE_STRING);

  //check product id is valid and is in DB and get product info
  $q = 'SELECT id, title, volume, season, price FROM products WHERE id=' . $pid;
  $r = @mysqli_query($dbc, $q);

  if (mysqli_num_rows($r) !== 1) { // Problem!
    //redirect user to fail page
    header('Location: index.php?p=failed_transacation');
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
    header('Location: index.php?p=failed_transacation');
	}
	// Fetch the product date
	$userRow = mysqli_fetch_array($r, MYSQLI_ASSOC);

  echo '<pre>' . print_r($prodRow) . '</pre>';
  echo '<pre>' . print_r($userRow) . '</pre>';


  // create stripe object with api key (test)
  \Stripe\Stripe::setApiKey(STRIPE_TEST_API_KEY);
  //create customer in stripe
  $customer = \Stripe\Customer::create(array(
    "email" => $email,
    "description" => $first_name ." ". $last_name,
    "source" => $token
  ));
  //charge customer
  $charge = \Stripe\Charge::create(array(
    "amount" => $prodRow['price'] * 100,
    "currency" => "usd",
    "description" => $prodRow['title'] .", Vol: ". $prodRow['volume'] .", Season: ". $prodRow['season'],
    "customer" => $customer->id
  ));


  echo '<pre>' . print_r($customer) . '</pre>';
  echo '<pre>' . print_r($charge) . '</pre>';

  //insert data into transaction table (using prepared statement)
  $q = 'INSERT INTO transactions (users_id, product_id, stripe_customer_id, stripe_transaction_id, payment_status, currency, payment_amount)
  VALUES (?,?,?,?,?,?,?)';
  $stmt = mysqli_prepare($dbc, $q);
  mysqli_stmt_bind_param($stmt, 'iissssi', $userRow['id'], $prodRow['id'], $customer->id, $charge->id, $charge->status, $charge->currency, $charge->amount);
  $stmt = mysqli_prepare($dbc, $q);
  mysqli_stmt_execute($stmt);
  if (mysqli_stmt_affected_rows($stmt) <= 0) { //IF PROBLEM THEN REDIRECT
    header('Location: index.php?p=failed_transacation');
  }

  //insert data into orders table
  $q = 'INSERT INTO orders (users_id, product_id, stripe_customer_id, stripe_transaction_id, payment_status, currency, payment_amount)
  VALUES (?,?,?,?,?,?,?)';
  $stmt = mysqli_prepare($dbc, $q);
  mysqli_stmt_bind_param($stmt, 'iissssi', $userRow['id'], $prodRow['id'], $customer->id, $charge->id, $charge->status, $charge->currency, $charge->amount);
  $stmt = mysqli_prepare($dbc, $q);
  mysqli_stmt_execute($stmt);
  if (mysqli_stmt_affected_rows($stmt) <= 0) { //IF PROBLEM THEN REDIRECT
    header('Location: index.php?p=failed_transacation');
  }



} else { //page accessed in error (redirect)
  echo "ERROR";
}

// //customer data
// $customerData = [
//   'id' => $charge->customer,
//   'first_name' => $first_name,
//   'last_name' => $last_name,
//   'email' => $email
// ];
// //instaniate customer
// $customer = new Customer();
// //add customer to DB
// $customer->addCustomer($customerData);
//
// //transaction data
// $transactionData = [
//   'id' => $charge->id,
//   'customer_id' => $charge->customer,
//   'product' => $charge->description,
//   'amount' => $charge->amount,
//   'currency' => $charge->currency,
//   'status' => $charge->status,
// ];
// //instaniate customer
// $transaction = new Transaction();
// //add customer to DB
// $transaction->addTransaction($transactionData);
//
// // print_r($charge);
//
// // redirect to success page
// header('Location: success.php?tid='. $charge->id .'&product='. $charge->description);
//
//
//
//
// // $charge = \Stripe\Charge::create(['amount' => 2000, 'currency' => 'usd', 'source' => 'tok_189fqt2eZvKYlo2CTGBeg6Uq']);
// // echo $charge;



 ?>
