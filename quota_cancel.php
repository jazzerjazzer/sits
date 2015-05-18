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

    $appID = $_GET['appID'];

    $sql = "DELETE FROM application WHERE appID = '$appID'";
	
	if ($conn->query($sql) == TRUE) {
		
		header('location:applications.php?result=2');
	} else {
	    echo "Error adding record: " . $conn->error;
		header('location:applications.php?result=1');
	}
?>