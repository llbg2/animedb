<?php

	require 'config.php';

	$con = mysqli_connect($host, $username, $password, $database);

	//Check Connetion
	if (mysqli_connect_errno($con)) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$id = addslashes($_REQUEST['id']);

	$image = mysqli_query($con, "SELECT * FROM character_image WHERE character_id='$id'");
	$image = mysqli_fetch_assoc($image);
	$image = $image['image'];

	header("Content-Type: image/jpeg");

	echo $image;

?>