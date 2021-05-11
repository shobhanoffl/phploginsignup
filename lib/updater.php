<?php

// initializing variables
$ini = parse_ini_file('cred.ini');
$server_name=$ini['server_name'];
$db_user=$ini['db_user'];
$db_pass=$ini['db_pass'];
$db_name=$ini['db_name'];

// connect to the database
$db = mysqli_connect($server_name,$db_user,$db_pass,$db_name);

//PAGE NAME EXTRACT
$pgname=array(); 

$sql3 = "SELECT pgname FROM pagenames";
$result3 = mysqli_query($db, $sql3);
while($row3=mysqli_fetch_assoc($result3)){
    $pgname[] = $row3['pgname'];
}

//DELETE BLOG POST
if (isset($_GET['bno'])){
    $sql4 = "DELETE FROM blogs WHERE bno='" .$_GET["bno"]. "'";
    $result4 = mysqli_query($db, $sql4);
    if(mysqli_query($db, $sql4)){
        header('location: delpost.php?postdel=success');
    }
    else{
        header('location: delpost.php?postdel=failed');
    }
}

//DELETE PAGE
if (isset($_GET['pno'])){
    $sql7 = "DELETE FROM pagenames WHERE pno='" .$_GET["pno"]. "'";
    $result7 = mysqli_query($db, $sql7);
    if(mysqli_query($db, $sql7)){
        header('location: delpage.php?pagedel=success');
    }
    else{
        header('location: delpage.php?pagedel=failed');
    }
}

//DELETE USER
if (isset($_GET['uno'])){
    $sql9 = "DELETE FROM users WHERE uno='" .$_GET["uno"]. "'";
    $result9 = mysqli_query($db, $sql9);
    if(mysqli_query($db, $sql9)){
        header('location: dash.php?userdel=success');
    }
    else{
        header('location: dash.php?userdel=failed');
    }
}
?>
