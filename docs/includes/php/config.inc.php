<?php # configuration for site - config.inc.php

/*
 *  File name: config.inc.php
 *  Created by: Larry E. Ullman
 *  Contact: Larry@LarryUllman.com, LarryUllman.com
 *  Last modified: June 5, 2012
 *
 *  Configuration file does the following things:
 *  - Has site settings in one location.
 *  - Stores URLs and URIs as constants.
 *  - Sets how errors will be handled.
 */

# ******************** #
# ***** SETTINGS ***** #

// Errors are emailed here:
$contact_email = 'address@example.com';

// Determine whether we're working on a local server
// or on the real server:
$host = substr($_SERVER['HTTP_HOST'], 0, 5);
if (in_array($host, array('local', '127.0', '192.1'))) {
    $local = TRUE;
} else {
    $local = FALSE;
}

// Determine location of files and the URL of the site:
// Allow for development on different servers.
if ($local) {

    // Always debug when running locally:
    $debug = TRUE;

    // Define the constants:
    define('BASE_URI', '/var/www/html/pro_dev/SD_Fitness--sean/docs/');
    define('BASE_URL', '127.0.0.1:8080/pro_dev/SD_Fitness--sean/docs/');
    define('MYSQL', BASE_URI . 'includes/php/mysql.inc.php');
    define('STRIPE_TEST_API_KEY', 'sk_test_5HUh09ZK7QHVG5FfRcCcu2BG');

} else {

    define('BASE_URI', '/path/to/live/html/folder/');
    define('BASE_URL', 'http://www.example.com/');
    define('DB', '/path/to/live/mysql.inc.php');
    define('STRIPE_LIVE_API_KEY', '...');

}

/*
 *  Most important setting!
 *  The $debug variable is used to set error management.
 *  To debug a specific page, add this to the index.php page:

if ($p == 'thismodule') $debug = TRUE;
require('./includes/config.inc.php');

 *  To debug the entire site, do

$debug = TRUE;

 *  before this next conditional. (if this is on a live server)
 */

// Assume debugging is off.
if (!isset($debug)) {
    $debug = FALSE;
}


# ***** END OF SETTINGS ***** #
# *************************** #


# ******************** #
# ***** SESSIONS ***** #
session_name('SD_Fitness_Sess');
session_start();

if (!isset($_SESSION['SD_Fitness_Sess']['lang'])){
  //set langauage to english by default
  $_SESSION['SD_Fitness_Sess']['lang'] = "en";

} else if (isset($_GET['lang']) && $_SESSION['SD_Fitness_Sess']['lang'] != $_GET['lang'] && !empty($_GET['lang'])) {

  if ($_GET['lang'] == "en") {
    $_SESSION['SD_Fitness_Sess']['lang'] = "en";
  } else if ($_GET['lang'] == "fr") {
    $_SESSION['SD_Fitness_Sess']['lang'] = "fr";
  }
}

echo $_SESSION['SD_Fitness_Sess']['lang'];

require_once("languages/" . $_SESSION['SD_Fitness_Sess']['lang'] . ".php");




# ***** END OF SESSIONS ***** #
# *************************** #



# **************************** #
# ***** ERROR MANAGEMENT ***** #

// Create the error handler:
function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars) {

    global $debug, $contact_email;

    // Build the error message:
    $message = "An error occurred in script '$e_file' on line $e_line: $e_message";

    // Append $e_vars to the $message:
    $message .= print_r($e_vars, 1);

    if ($debug) { // Show the error.

        echo '<div class="error">' . $message . '</div>';
        debug_print_backtrace();

    } else {

        // Log the error:
        error_log ($message, 1, $contact_email); // Send email.

        // Only print an error message if the error isn't a notice or strict.
        if ( ($e_number != E_NOTICE) && ($e_number < 2048)) {
            echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div>';
        }

    } // End of $debug IF.

} // End of my_error_handler() definition.

// Use my error handler:
set_error_handler('my_error_handler');

# ***** END OF ERROR MANAGEMENT ***** #
# *********************************** #


# ***** FUNCTIONS ***** #
# ********************* #

/* ----- REDIRECT FUNCTION ----- */
# this function redirects invalid users
# it takes 2 arguments: the session element to check and the destination to
# where the user will be redirected
function redirect_invalid_user($check = 'user_id', $destination = 'index.php', $protocol = 'http://') {

    //check if headers have already been sent:
    if (!headers_sent()) { //redirect code
        //check for the session item:
        if (!isset($_SESSION['SD_Fitness_Sess'][$check])) {
            $url = $protocol . BASE_URL . $destination;   //define URL
            header("Location: $url");
            exit();   //quit the script
        }
    } else { //display error message
        include_once('./includes/php/header.inc.php');
        trigger_error('You do not have permission to access this page. Please log in and try again.');
        include_once('./includes/php/footer.inc.php');
    }

}   //END OF redirect_invalid_user() function
/* ----- END OF redirect funcion ----- */


/* ----- escape data function ----- */
# create function to make data safe to use in queries
# takes one arguments (the data to be treated), with the dbc
# returns the treated data (as a string)
function escape_data ($data, $dbc) {

    #strip the slashes if Magic Quotes is on:
    if (get_magic_quotes_gpc()) $data = stripslashes($data);

    #apply trim() and mysqli_real_escape_string()
    return mysqli_real_escape_string($dbc, trim($data));

}   //END OF: escape_data() function
/* ----- END OF escape data funcion ----- */






# ***************************** #
# ***** END OF FUNCTIONS ***** #



//omit the closing PHP tag to avoid 'headers already sent' errors
