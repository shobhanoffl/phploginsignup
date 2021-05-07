<?php
include('lib/add.php');
include('lib/updater.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>    
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</body>
<!--NAVIGATION BAR-->
<nav class="navbar navbar-expand-md" style="background:whitesmoke;">
  <!-- Brand -->
  <a class="navbar-brand" href="#">My Blog</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="fa fa-bars" style="color:#0069D9;"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      
  	<?php foreach($pgname as $pgname2) : ?>
      <li class="nav-item">
      <a class="nav-link" href="#"><?php echo $pgname2 ?></a>
      </li>
  	<?php endforeach ?>
    
    </ul>
    <ul class="navbar-nav ml-auto">
      <li><a href="#" class=nav-link><i class="fa fa-user-plus"></i> Sign Up</a></li>
      <li><a href="#" class=nav-link><i class="fa fa-user-circle"></i> Login</a></li>
    </ul>
  </div>
</nav>
<!--NAVIGATION BAR-->
<br><br>
<div style="width: 25%; float: left;"><br></div>
<div style="width: 50%; float:left; background:white; border: 1px solid black; padding:10px;">
    <div class="container form-group" style="padding:30px 40px 0px 40px;">
    <h class="h2 d-flex justify-content-center">Signup</h><br>
    <form method="POST" action="signup.php">
    <label for="name">Name:</label><br>
    <input type="text" class="form-control" size="10" placeholder="Enter your Name" name="name"><br>
    <label for="email">Email:</label><br>
    <input type="email" class="form-control" size="10" placeholder="Enter Your Email" name="email"><br>
    <label for="pass">Password:</label><br>
    <input type="password" class="form-control" size="10" placeholder="Enter your Password" name="pass"><br>
    <label for="cpass">Confirm Password:</label><br>
    <input type="password" class="form-control" size="10" placeholder="Reenter Password" name="cpass"><br>
    <label for="scode">Enter your Secret Code</label><br>
    <input type="text" class="form-control" size="10" placeholder="Enter Secret Code" name="scode"><br>
    <button type="submit" class="btn btn-primary" name="signup_btn">Signup</button>
    <small style="padding-left:10px; vertical-align:bottom;">Already a member? <a href="#">Log in</a></small>
    <br><br>
    <?php  if (count($errors) > 0) : ?>
        <div class="alert alert-danger" role="alert">
  	<?php foreach ($errors as $error) : ?>
  	    <span><i class="fa fa-asterisk"></i> <?php echo $error ?></span><br>
  	<?php endforeach ?>
        </div> 
    <?php  endif ?>
    </form>
    </div>
    <br>
</div>
<div style="width: 25%; float: left;"><br></div>
</html>