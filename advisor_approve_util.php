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

	$compID = $_GET['compID'];
	$userID = $_GET['userID'];

	$sql = "UPDATE company SET status = \"approved\" WHERE compID = '$compID'";
	if ($conn->query($sql) == TRUE) {
		if ($conn->query($sql) == TRUE) {
			header('location:advisor_approve.php?result=2');
		}else{
			header('location:advisor_approve.php?result=1');
		}
	}
?>