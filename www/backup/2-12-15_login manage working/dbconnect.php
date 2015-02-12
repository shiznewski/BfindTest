<?php

$username = "admin_admin";
$password = "sqlpass323";
$database = "admin_pub_sleuth";

$conn = mysql_connect('localhost', $username, $password);
if (!$conn) {
  //Connection to the database has failed.
  echo "Could not connect to the database: " . mysql_error();
  exit();
}

//Successfully connected to the database
  
//Select the database we will be using
$db_selected = mysql_select_db($database, $conn);
if (!$db_selected) {
  //Database could not be selected
  die("Can\'t select database " . $database . " : " . mysql_error());
}
?>