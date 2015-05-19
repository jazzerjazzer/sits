<?php
	$servername = "localhost";
	$username = "root";
	$password = "comodo365";
	$dbname = "project";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	     die("Connection failed: " . $conn->connect_error);
	}
	
	$userID = $_GET["secretaryID"];
	$appID = $_GET['appID'];

	$sql = "UPDATE application SET approval = \"approved\", secretaryID = '$userID' WHERE appID = '$appID'";
	echo $sql;
	if ($conn->query($sql) == TRUE) {
		header('location:secretary_see_applications.php?result=2');
	}else{
		header('location:secretary_see_applications.php?result=1');
	}
?>