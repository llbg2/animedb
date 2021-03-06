<?php

	//Config

	require 'config.php';
	require 'functions.php';

	//Variables


	$scon = mysql_connect($host, $username, $password);
	if (!$scon) {
		die('Could not connect');
	}

	$_POST = sanitize($_POST);

	$gender = $_POST['gender'];
	$age = $_POST['approx_age'];
	$hairColour = $_POST['hair_colour'];
	$hairLength = $_POST['hair_length'];
	$eyeColour = $_POST['eye_colour'];
	$earType = $_POST['ear_type'];
	$weapons = $_POST['weapons'];

	mysql_close($scon);

	try {
		// Init
		$DBH = new PDO("mysql:host=$host;dbname=$database", $username, $password);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		//Query Craft
		$query = "SELECT * FROM characters WHERE 1=1";

		if ($gender != "None") {
			if (!empty($gender)) {
				$query = $query . " AND gender='$gender'";
			}
		}

		if ($age != "None") {
			if(!empty($age)) {
				$query = $query . " AND approx_age='$age'";
			}
		}
		

		if(!empty($hairColour)) {
			$query = $query . " AND hair_colour='$hairColour'";
		}

		if ($hairLength != "None") {
			if(!empty($hairLength)) {
				$query = $query . " AND hair_length='$hairLength'";
			}
		}

		if(!empty($eyeColour)) {
			$query = $query . " AND eye_colour='$eyeColour'";
		}

		if ($earType != "None") {
			if(!empty($earType)) {
				$query = $query . " AND ear_type='$earType'";
			}
		}
		
		if(!empty($weapons)) {
			$query = $query . " AND weapons='$weapons'";
		}

		//Prepare and Exec
		$STH = $DBH->query($query);
		$STH->setFetchMode(PDO::FETCH_ASSOC);

		//Build Table
		echo "<table class='table table-striped' id='resulttable' ><thead><th>Image</th><th>Name</th><th>Anime</th></thead><tbody>";

		while ($row = $STH->fetch()) {
			echo "<tr class='resulttr'><td><image height=140 width=140 src=getimage.php?id=" . $row['character_id'] . "/></td>";
			echo "<td>" . $row['character_name'] . "</td>";
			echo "<td>" . $row['anime'] . "</td>";
			echo "<td class='rowid' style='display:none;'>" . $row['character_id'] . "</td>";
		}

		echo "</tbody></table>";

	} catch(PDOException $e) {
		echo $e->getMessage();
	}
	
	/*
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
	*/
?>