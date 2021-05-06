<?php
session_start();

// initializing variables
$ini = parse_ini_file('cred.ini');
$errors = array();
$server_name=$ini['server_name'];
$db_user=$ini['db_user'];
$db_pass=$ini['db_pass'];
$db_name=$ini['db_name'];

// connect to the database
$db = mysqli_connect($server_name,$db_user,$db_pass,$db_name);

// REGISTER USER
if (isset($_POST['signup_btn'])) {
  // receive all input values from the form
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $pass = mysqli_real_escape_string($db, $_POST['pass']);
  $cpass = mysqli_real_escape_string($db, $_POST['cpass']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($name)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($pass)) { array_push($errors, "Password is required"); }
  if ($pass != $cpass) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($pass);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (name,email,pass) VALUES('$name', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: lib/dash.php');
  }
}

//LOGIN USER
if (isset($_POST['login_btn'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $pass = mysqli_real_escape_string($db, $_POST['pass']);

  if (empty($email)) {
  	array_push($errors, "Email is required");
  }
  if (empty($pass)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($pass);
  	$query = "SELECT * FROM users WHERE email='$email' AND pass='$password'";
  	$results = mysqli_query($db, $query);

    $query2="SELECT name from users where email = '$email'";
    $results2 = mysqli_query($db,$query2);
    $row2 = mysqli_fetch_array ($results2);

  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['email'] = $email;
      $_SESSION['name'] = $row2['name'];
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: lib/dash.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}
?>