<?php

	//Config

	require 'config.php';

	//Variables

	$gender = $_POST['gender'];
	$age = $_POST['approx_age'];
	$hairColour = $_POST['hair_colour'];
	$hairLength = $_POST['hair_length'];
	$eyeColour = $_POST['eye_colour'];
	$earType = $_POST['ear_type'];
	$bodyType = $_POST['body_type'];
	$weapons = $_POST['weapons'];

	//Create Connection
	$con = mysqli_connect($host, $username, $password, $database);

	//Check Connetion
	if (mysqli_connect_errno($con)) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$query = "SELECT * FROM characters WHERE gender='$gender'";

	if(!empty($age)) {
		$query = $query . " AND approx_age='$age'";
	}

	if(!empty($hairColour)) {
		$query = $query . " AND hair_colour='$hairColour'";
	}

	if(!empty($hairLength)) {
		$query = $query . " AND hair_length='$hairLength'";
	}

	if(!empty($eyeColour)) {
		$query = $query . " AND eye_colour='$eyeColour'";
	}

	if(!empty($earType)) {
		$query = $query . " AND ear_type='$earType'";
	}

	if(!empty($bodyType)) {
		$query = $query . " AND body_type='$bodyType'";
	}

	if(!empty($weapons)) {
		$query = $query . " AND weapons='$weapons'";
	}

	$result = mysqli_query($con, $query);

	echo "<table class='table table-striped' ><thead><th>Image</th><th>Name</th><th>Anime</th></thead><tbody>";

	while ($row = mysqli_fetch_array($result)) {
		echo "<tr><td><image height=140 width=140 src=getimage.php?id=" . $row['character_id'] . " </td>";

		echo "<td>" . $row['character_name'] . "</td>";
		echo "<td>" . $row['anime'] . "</td></tr>";
	}

	echo "</tbody></table>";

	mysqli_close($con);
?>