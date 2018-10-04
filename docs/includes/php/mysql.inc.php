<?php

# script to connect to the DB
# this script should be protected

# define constants for a user with access to 'ecommerce1' DB
DEFINE ('DB_USER', 'ecomUser');
DEFINE ('DB_PASSWORD', 'epassword');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'ecommerce1');

# make DB connection
$dbc = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

# establish the charset
mysqli_set_charset($dbc, 'utf-8');
