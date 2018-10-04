<?php
# TEST script to select users from DB


//include config file
require('./includes/php/config.inc.php');





require(MYSQL);







$q = "SELECT id, type, username, email, pass, first_name, last_name, date_created, date_expires FROM users";
$r = @mysqli_query($dbc, $q);


if (mysqli_num_rows($r) > 0) { // A match was made.

  //setup table for data
  echo '
    <table>
    <thead>
      <tr>
        <th>User ID</th>
        <th>User Type</th>
        <th>Username</th>
        <th>Email</th>
        <th>Pass (hashed)</th>
        <th>First Name</th>
        <th>Last Name<th>
        <th>Date Created</th>
        <th>Date Expires</th>
      </tr>
    </thead>
    <tbody>
  ';



  //fetch data and print the data
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
    echo '
    <tr>
      <td>' . $row['id'] . '</td>
      <td>' . $row['type'] . '</td>
      <td>' . $row['username'] . '</td>
      <td>' . $row['email'] . '</td>
      <td>' . $row['pass'] . '</td>
      <td>' . $row['first_name'] . '</td>
      <td>' . $row['last_name'] . '</td>
      <td>' . $row['date_created'] . '</td>
      <td>' . $row['date_expires'] . '</td>
    </tr>';
  }

  //close table
  echo '</tbody></table>';

  //free up resources
  mysqli_free_result($r);

  //close db connection
  mysqli_close($dbc);

} else { //no users
  echo '<h3>There are no users to shoe </h3>';
}

  ?>
