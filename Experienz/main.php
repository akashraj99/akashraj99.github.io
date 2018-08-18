<html>
<head>
	
<link rel="stylesheet" type="text/css" href="style2.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="jquery-2.1.3.js"></script>
<script>
$(document).ready(function() {
	$('.container').load('posts.php');
});

$(document).ready(function() {

	$('.line_post').on('click', function(e) {
		e.preventDefault();
	var line = $('#line_1').val();
	if(line != '') {
		$.ajax({
			type: 'POST',
			url: 'post.php',
			cache: false,
			data: $('.post_form').serialize(),
			success: function(duh) {
				alert(duh);
			}
		});
	}
	else {
		alert('Please fill Line 1');
	}
});
});
</script>
</head>
<body>

<div class="blackout"></div>

<div class="post_box">

<center>

	<form class="post_form">
	
		<input type="text" id="line_1" name="line_1" class="line" placeholder="Line 1" />
		<br /><br />
		<input type="text" name="line_2" class="line" placeholder="Line 2" />
		<br /><br />
		<input type="text" name="line_3" class="line" placeholder="Line 3" />
		<br /><br />
		<input type="text" name="line_4" class="line" placeholder="Line 4" />
		<br /><br />
		<input type="submit" value="POST" class="line_post">
	
	</form>

</center>

</div>

<div class="top_bar">

	<center><font class="header">Xperienz</font></center>
	
</div>

<br /><br />

<div class="container">

</div>


<!--

<div class="topnav" >
<center>
	<div class="duh"></div>
	<div class="nav">
  <a href="#" ><button class="nav_but"><i class="material-icons">&#xe838;</i>All</button></a>
  <a href="#" ><button  class="nav_but"><i class="material-icons">&#xe417;</i>Horror</button></a>
  <a href="#" ><button class="nav_but"><i class="material-icons">&#xe87e;</i>Romantic</button></a>
  <a href="#" ><button class="nav_but"><i class="material-icons">&#xe53a;</i>Dreams</button></a>
  <a href="#" ><button class="nav_but"><i class="material-icons">&#xe24e;</i>Funny</button></a>
  </div>
  <div class="search_form">
  <i class="fa fa-search"></i>
  <input type="text" placeholder="Click to search" class="search_box" >
  </div>
</center>
</div>
<div class="OuterBox" id="OuterBox">
<div class="box1" id="box1">
	<div class ="sub_box_1" id="sub_box_1">
		<div>
			<img src="user.png" height="75px" width="75px">
		</div>
		<div>
			<p> UserName </p>
		</div>
	</div>
	<div class ="sub_box_2" id="sub_box_2">Stories 2</div>
	<div class ="sub_box_3" id="sub_box_3"></div>
	<div class ="sub_box_4" id="sub_box_4"></div>
</div>
<div class="box2" id="box2"> </div>
</div>
-->

</body>