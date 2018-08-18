<?php

$con = mysqli_connect('localhost', 'root', 'rootpassword', 'experienz');

if(!$con) {
	die('Couldn\'t connect to the database: ' . mysqli_error());
}
session_start();

$uname = $_POST['username'];

$pword = $_POST['password'];

$query = mysqli_query($con, "SELECT * FROM `members` WHERE `username` = '$uname' && `password` = '$pword'");

$num = mysqli_num_rows($query);

if($num == 1) {
	$_SESSION['username'] = $uname;
	$time = time()+3600*24;
	setcookie('cookie',$uname,$time);
}

echo $num;

?>