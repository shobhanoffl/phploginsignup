<?php

// initializing variables
$ini = parse_ini_file('cred.ini');
$server_name=$ini['server_name'];
$db_user=$ini['db_user'];
$db_pass=$ini['db_pass'];
$db_name=$ini['db_name'];

// connect to the database
$db = mysqli_connect($server_name,$db_user,$db_pass,$db_name);

//arrays
$pgname=array();

$sql = "SELECT pgname FROM pagenames";
$result = mysqli_query($db, $sql);
while($row=mysqli_fetch_assoc($result)){
    $pgname[] = $row['pgname'];
}

?>