<?php

$con = mysqli_connect();

$line_1 = $_POST['line_1'];
$line_2 = $_POST['line_2'];
$line_3 = $_POST['line_3'];
$line_4 = $_POST['line_4'];

$username = $_COOKIE['cookie'];

function random_color_part1() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0');
}

function random_color1() {
    return random_color_part1() . random_color_part1() . random_color_part1();
}

$random1 = random_color1();

function random_color_part2() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '1');
}

function random_color2() {
    return random_color_part2() . random_color_part2() . random_color_part2();
}

$random2 = random_color2();

	mysqli_query($con, "INSERT INTO `posts`(`post_id`, `username`, `line_1`, `line_2`, `line_3`, `line_4`, `background`, `color`) VALUES (`post_id`, '$username', '$line_1', '$line_2', '$line_3', '$line_4', '$random1', '$random2')");

?>