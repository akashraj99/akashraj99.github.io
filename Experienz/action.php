<?php

$con = mysqli_connect('localhost', 'root', 'rootpassword', 'website');

$id = $_POST['com_id'];

$user_email = $_COOKIE['remember_me'];

$type = $_POST['type'];

$up = mysqli_query($con, "SELECT `id` FROM `com_likes` WHERE `email` = '$user_email' && `com_id` = '$id' && `type` = 'Up'");

$down = mysqli_query($con, "SELECT `id` FROM `com_likes` WHERE `email` = '$user_email' && `com_id` = '$id' && `type` = 'Down'");

if($type == 'up') {

	if(mysqli_num_rows($up) == 0) {
	
		$q = mysqli_query($con, "INSERT INTO `com_likes` (`id`, `com_id`, `email`, `type`) VALUES (`id`, '$id', '$user_email', 'Up')");
	
		$req = mysqli_query($con, "SELECT `ups` FROM `comments` WHERE `com_id` = '$id'");
			
		while($d = mysqli_fetch_array($req)) {
		
			$ups = $d['ups'];
			
			$function = $ups + 1;
			
			mysqli_query($con, "UPDATE `comments` SET `ups` = '$function' WHERE `com_id` = '$id'");			
			
		}
		
		if(mysqli_num_rows($down) != 0) {
		
			mysqli_query($con, "DELETE FROM `com_likes` WHERE `com_id` = '$id' && `email` = '$user_email' && `type` = 'Down'");
			
			echo '+1 & -1';
		
		}
		
		else {
		
			echo '+1';
			
		}
		
	}
	
	else {
	
		mysqli_query($con, "DELETE FROM `com_likes` WHERE `com_id` = '$id' && `email` = '$user_email' && `type` = 'Up'");
	
		echo 'Already +1';
	
	}
	
}

else {

	if(mysqli_num_rows($down) == 0) {
	
		$q = mysqli_query($con, "INSERT INTO `com_likes` (`id`, `com_id`, `email`, `type`) VALUES (`id`, '$id', '$user_email', 'Down')");
	
		$req = mysqli_query($con, "SELECT `downs` FROM `comments` WHERE `com_id` = '$id'");
			
		while($d = mysqli_fetch_array($req)) {
		
			$downs = $d['downs'];
			
			$function = $downs - 1;
			
			mysqli_query($con, "UPDATE `comments` SET `downs` = '$function' WHERE `com_id` = '$id'");			
			
		}
		
		if(mysqli_num_rows($up) != 0) {
		
			mysqli_query($con, "DELETE FROM `com_likes` WHERE `com_id` = '$id' && `email` = '$user_email' && `type` = 'Up'");
			
			echo '-1 & +1';
		
		}
		
		else {
		
			echo '-1';
			
		}
		
	}
	
	else {
	
		mysqli_query($con, "DELETE FROM `com_likes` WHERE `com_id` = '$id' && `email` = '$user_email' && `type` = 'Down'");
	
		echo 'Already -1';
	
	}
	
}

?>