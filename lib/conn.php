<?php
$ini = parse_ini_file('lib/cred.ini');
$servername = $ini['server_name'];
$username = $ini['db_user'];
$password = $ini['db_pass'];

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>