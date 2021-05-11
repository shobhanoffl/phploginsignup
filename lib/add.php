<?php
session_start();
// initializing variables
$ini = parse_ini_file('cred.ini');
$ini2 = parse_ini_file('key.ini');
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
  $scode = mysqli_real_escape_string($db, $_POST['scode']);

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

  if (empty($scode)) {
  	array_push($errors, "Secret Code is Missing");
  }
  else{
    if ($scode!=md5($ini2['scode'])) {
      array_push($errors, "Secret Code is Incorrect");
    }
  }
  


  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($pass);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (name,email,pass) VALUES('$name', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
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

    $query2="SELECT name,admin from users where email = '$email'";
    $results2 = mysqli_query($db,$query2);
    $row2 = mysqli_fetch_array ($results2);

  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['email'] = $email;
      if($row2['admin']==1){
        $_SESSION['admin'] = $row2['admin'];
      }
      $_SESSION['name'] = $row2['name'];
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: lib/dash.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

//NEW BLOG POST
if(isset($_POST['addblog_btn'])){
  $title=mysqli_real_escape_string($db, $_POST['title']);
  $subtitle=mysqli_real_escape_string($db, $_POST['subtitle']);
  $img=mysqli_real_escape_string($db, $_POST['img']);
  $editor=mysqli_real_escape_string($db, $_POST['editor']);
  $sources=mysqli_real_escape_string($db, $_POST['sources']);
  $author=$_SESSION['name'];
  $links=mysqli_real_escape_string($db, $_POST['links']);
  date_default_timezone_set("Asia/Calcutta");
  $date=date("d/m/Y");
  $time=date("H:i:s");
  $addblog_query = "INSERT INTO blogs (title,subtitle,img,content,sources,date,time,author,links) VALUES('$title','$subtitle','$img','$editor','$sources','$date','$time','$author','$links')";
  //mysqli_query($db, $addblog_query);
  if (mysqli_query($db, $addblog_query)){
    header('location: dash.php?addblog=success');
  }
  else{
    header('location: dash.php?addblog=failed');
  }
}

//NEW PAGE
if(isset($_POST['newpg_btn'])){
  $pgname=mysqli_real_escape_string($db, $_POST['newpage']);
  $pgdesc=mysqli_real_escape_string($db, $_POST['pagedesc']);
  $pgimg=mysqli_real_escape_string($db, $_POST['imglink']);
  $newpg_query = "INSERT INTO pagenames (pgname,pgdesc,pgimg) VALUES('$pgname','$pgdesc','$pgimg')";
  //mysqli_query($db, $newpg_query);
  if (mysqli_query($db, $newpg_query)){
    header('location: dash.php?addpage=success');
  }
  else{
    header('location: dash.php?addpage=failed');
  }
}
?> 