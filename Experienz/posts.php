<?php
$con = mysqli_connect('localhost','root','rootpassword','experienz');

if(!$con) {
	die('Couldn\'t connect to the database: ' . mysqli_error());
}

session_start();

$username = $_COOKIE['cookie'];

if($_POST) {
	$cat = $_POST['category'];
	$query = mysqli_query($con, "SELECT * FROM `posts` WHERE `category` = '$cat' ORDER BY `post_id` DESC");
	echo 'Hi';
}
else {
	$query = mysqli_query($con, "SELECT * FROM `posts` ORDER BY `post_id` DESC");
}

?>
<html>
<head>
<style type="text/css">
a {
	text-decoration:none;
	color:#196ee5 !important;
}
.post {
	width:auto;
	height:auto;
	max-width:480px;
	background:#fff;
	border-radius:2px;
	box-shadow:0 1px 2px #000;
}

.name_holder {
	width:auto;
	background:transparent;
	padding:10px;
}

.post:hover .name_holder {
	display:block;
}

.name {
	color:rgba(243,42,42,0.8);
	font-size:21px;
}

.content_holder {
	width:auto;
	padding:10px;
	box-shadow:0 1px 2px #ccc;
}

.lines {
	line-height:2em;
	font-size:21px;
}

.actions {
	width:460px;
	padding:10px;
	display:table;
	background:#cadade;
}

.votes {
	display:table-cell;
	width:40%;
}

.damn {
	width:40%;
	display:table-cell;
}

.tag {
	width:20%;
	display:table-cell;
	text-align:right;
}

.vote_but {
	display:table-cell;
	cursor:pointer;
	background:#fff;
}

.vote_but:hover {
	background:#196ee5;
}

.vote_but[name="points"] {
	background:#ff9900;
	width:auto;
}	

.vote_but img {
	width:30px;
	height:30px;
}
</style>
<script src="jquery-2.1.3.js"></script>
<script>
$(document).ready(function() {
	$('.vote_but').click(function() {
		var ID = $(this).attr('id');
		var type = $(this).attr('name');
		var dial = type + '_but_';
		var id = ID.split(dial);
		var id = id[1];
		var url = 'post_id=' + id + '&type=' + type;
		alert(url);
		
		$.ajax({
			type: 'POST',
			url: 'vote.php',
			cache: false,
			data: url,
			success: function(result){
				alert(result);
				if(result == '+1') {
					var image = '#up_but_' + id;
					$(image).css('background', '#196ee5');
				}
				else if(result == 'Already +1') {
					var image = '#up_but_' + id;
					$(image).css('background', '#fff');
				}
				else if(result == '+1 & -1') {
					var image1 = '#up_but_' + id;
					$(image1).css('background', '#196ee5');
					var image2 = '#down_but_' + id;
					$(image2).css('background', '#fff');
				}
				else if(result == '-1') {
					var name = '#down_' + id;
					var down = $(name).text;
					var n_down = ++down;
					$(name).val(n_down);
				}
				else if(result == 'Already -1') {
					var minus = '#down_' + id;
					var down = $(minus).text;
					var n_down = --down;
					$(minus).val(n_down);
				}
				else if(result == '-1 & +1') {
					var name = '#up_' + id;
					var up = $(name).text;
					var n_up = --up;
					$(name).val(n_up);
					var minus = '#down_' + id;
					var down = $(minus).text;
					var n_down = ++down;
					$(minus).val(n_down);
				}
				$('.container').load('posts.php');
			}
		});
	});
});
</script>
</head>
<body>

<center>

<?php

				while($row = mysqli_fetch_array($query)) {

				$id = $row['post_id'];
				
?>

	<div class="post">
	
		<div class="name_holder">
		
			<a href="profile.php?username=<?php echo $row['username']; ?>"><font class="name"><?php echo $row['username']; ?></font></a>
		
		</div>
		
		<div class="content_holder" style="background:<?php echo $row['background']; ?>;color:<?php echo $row['color']; ?>;">
		
			<?php		
			
				if(empty($row['para'])) {
					
					
			?>
			
<center>

			<font class="lines"><?php echo $row['line_1']; ?></font>
			
			<?php 
			
				if($row['line_2'] != '') {
				
			?>
				
<br />

				<font class="lines"><?php echo $row['line_2']; ?></font>
				
			<?php 
			
				}
				
			?>
			
			<?php 
			
				if($row['line_3'] != '') {
				
			?>
				
<br />

				<font class="lines"><?php echo $row['line_3']; ?></font>
				
			<?php 
			
				}
				
			?>
			
			<?php 
			
				if($row['line_4'] != '') {
				
			?>
				
<br />

				<font class="lines"><?php echo $row['line_4']; ?></font>
				
			<?php 
			
				}
				
			?>
			
</center>
			
			<?php
			
				}
				
				else {
				
			?>
			
			<p class="para"><?php echo $row['para']; ?></p>
			
			<?php
			
				}
				
			?>
		
		</div>
		
		<div class="actions">
		
			<div class="votes">

<?php 

	$q = mysqli_query($con, "SELECT * from `likes` WHERE `post_id` = '$id' && `username` = '$username'");
	
	$no = mysqli_num_rows($q);
	
	while($duh = mysqli_fetch_array($q)) {
			
		$type = $duh['type'];
			
	}
	
	if($no != '0') {
	
		if($type == 'up') {
		
		echo
		
			'<div class="vote_but" name="up" style="background:#196ee5;" id="up_but_' . $id . '"><img src="up.png" /></div>
				
			<div class="vote_but" name="down" id="down_but_' . $id . '"><img src="down.png" /></div>';
	
		}
		
		else if($type == 'down') {
		
		echo
		
			'<div class="vote_but" name="up" id="up_but_' . $id . '"><img src="up.png" /></div>
				
			<div class="vote_but" name="down" style="background:#196ee5;" id="down_but_' . $id . '"><img src="down.png" /></div>';
		
		}	
	
	}
	
	else {
	
		echo 
		
			'<div class="vote_but" name="up" id="up_but_' . $id . '"><img src="up.png" /></div>
				
			<div class="vote_but" name="down" id="down_but_' . $id . '"><img src="down.png" /></div>';
			
	}

?>
			
			</div>
			
			<div class="damn"></div>
			
			<div class="tag"><font style="color:#000;font-size:21px;">(<?php $c_up = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `likes` WHERE `post_id` = '$id' && `type` = 'up'")); $c_down = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `likes` WHERE `post_id` = '$id' && `type` = 'down'")); $count = $c_up - $c_down; echo $count;?>)</font></div>
		
		</div>
	
	</div>
	
<br />

<?php

}

?>

</center>

</body>
</html>