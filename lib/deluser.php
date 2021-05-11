<?php
include('updater.php');
include('add.php');

if(!isset($_SESSION['admin']) || empty($_SESSION['admin'])){
  header('location: ../index.php?logout=success');
  exit();
}
?> 

<!DOCTYPE html>
<html>
<head>
<style>
a{
  text-decoration:none;
}
</style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <script src="https://cdn.tiny.cloud/1/62tdblaj0rg0lb7itafj9i1n6nku6s8h5p42u34v8cn71vgo/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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
      <li><a href="../index.php?logout=success" style="color: red;" class=nav-link><i class="fa fa-user-times"></i> Logout</a></li>
    </ul>
  </div>
</nav>
<!--NAVIGATION BAR-->

<div style="width:25%;float:left;"><br></div>
<div style="width:50%;float:left;">
<br>
<h5>Remove User</h5>
<hr>
<small class="mr-auto">Welcome <i class="text-primary"><?php echo $_SESSION['name']; ?></i> Signed in as <i class="text-primary"><?php echo $_SESSION['email']; ?></i></small><br><br>
<a href="dash.php"><button class="btn btn-info"><i class="fa fa-arrow-left"></i> Back</button></a><br><br>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">User.No</th>
      <th scope="col">User Name</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
<?php
  $sql8 = "SELECT * FROM users WHERE admin IS NULL";
  $result8 = mysqli_query($db, $sql8);
  while($row8 = mysqli_fetch_array($result8)){ 
?>
<tr>
<td><?php echo $row8["uno"]; ?></td>
<td><?php echo $row8["name"]; ?></td>
<td><?php echo $row8["email"]; ?></td>
<td><a class="text-danger" href="dash.php?uno=<?php echo $row8["uno"]; ?>"><i class="fa fa-trash"></i> Delete</a></td>
</tr>
<?php }
?>
</tbody>
</table>
<br><br>
</div>
<div style="width:25%;float:left;"><br></div>
</html>