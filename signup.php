<?php
include('lib/add.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Signup</h1><br>
    <form method="POST" action="signup.php">
    <input type="text" size="25" placeholder="name" name="name"><br>
    <input type="email" size="25" placeholder="email" name="email"><br>
    <input type="password" size="25" placeholder="pass" name="pass"><br>
    <input type="password" size="25" placeholder="cpass" name="cpass"><br>
    <button type="submit" name="signup_btn">Signup</button>
    </form><br>
    <h5>Errors</h5>
    <?php  if (count($errors) > 0) : ?>
        <div>
  	<?php foreach ($errors as $error) : ?>
  	    <p><?php echo $error ?></p>
  	<?php endforeach ?>
        </div> 
    <?php  endif ?>
</body>
</html>