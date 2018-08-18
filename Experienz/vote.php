<?php

$con = mysqli_connect('localhost','root','rootpassword','experienz');

if(!$con) {
	die('Couldn\'t connect to the database: ' . mysqli_error());
}

$username = $_COOKIE['cookie'];

$type = $_POST['type'];
$post_id = $_POST['post_id'];

$up = mysqli_query($con, "SELECT * FROM `votes` WHERE `post_id` = '$post_id' && `username` = '$username' && `type` = 'up'");
$down = mysqli_query($con, "SELECT * FROM `votes` WHERE `post_id` = '$post_id' && `username` = '$username' && `type` = 'down'");

if($type == 'up') {

	if(mysqli_num_rows($up) == 0) {
	
		$q = mysqli_query($con, "INSERT INTO `votes` (`vote_id`, `post_id`, `type`, `username`) VALUES (`vote_id`, '$post_id', 'up', '$username')");
	
		$req = mysqli_query($con, "SELECT `ups` FROM `posts` WHERE `post_id` = '$post_id'");
			
		while($d = mysqli_fetch_array($req)) {
		
			$ups = $d['ups'];
			
			$function = $ups + 1;
			
			mysqli_query($con, "UPDATE `posts` SET `ups` = '$function' WHERE `post_id` = '$post_id'");			
			
		}
		
		if(mysqli_num_rows($down) != 0) {
		
			mysqli_query($con, "DELETE FROM `votes` WHERE `post_id` = '$post_id' && `username` = '$username' && `type` = 'down'");
			
			echo '+1 & -1';
		
		}
		
		else {
		
			echo '+1';
			
		}
		
	}
	
	else {
	
		mysqli_query($con, "DELETE FROM `votes` WHERE `post_id` = '$post_id' && `username` = '$username' && `type` = 'up'");
		
		$req = mysqli_query($con, "SELECT `ups` FROM `posts` WHERE `post_id` = '$post_id'");
			
		while($d = mysqli_fetch_array($req)) {
		
			$ups = $d['ups'];
			
			$function = $ups - 1;
			
			mysqli_query($con, "UPDATE `posts` SET `ups` = '$function' WHERE `post_id` = '$post_id'");
		
		}
		
	
		echo 'Already +1';
	
	}
	
}

else if($type == 'down') {

	if(mysqli_num_rows($down) == 0) {
	
		$q = mysqli_query($con, "INSERT INTO `votes` (`vote_id`, `post_id`, `type`, `username`) VALUES (`vote_id`, '$post_id', 'down', '$username')");
	
		$req = mysqli_query($con, "SELECT `downs` FROM `posts` WHERE `post_id` = '$post_id'");
			
		while($d = mysqli_fetch_array($req)) {
		
			$downs = $d['downs'];
			
			$function = $downs + 1;
			
			mysqli_query($con, "UPDATE `posts` SET `downs` = '$function' WHERE `post_id` = '$post_id'");			
			
		}
		
		if(mysqli_num_rows($up) != 0) {
		
			mysqli_query($con, "DELETE FROM `votes` WHERE `post_id` = '$post_id' && `username` = '$username' && `type` = 'up'");
			
			echo '-1 & +1';
		
		}
		
		else {
		
			echo '-1';
			
		}
		
	}
	
	else {
	
		mysqli_query($con, "DELETE FROM `votes` WHERE `post_id` = '$post_id' && `username` = '$username' && `type` = 'down'");
		
		$req = mysqli_query($con, "SELECT `downs` FROM `posts` WHERE `post_id` = '$post_id'");
			
		while($d = mysqli_fetch_array($req)) {
		
			$downs = $d['downs'];
			
			$function = $downs - 1;
			
			mysqli_query($con, "UPDATE `posts` SET `downs` = '$function' WHERE `post_id` = '$post_id'");	

		}
	
		echo 'Already -1';
	
	}
	
}

?>