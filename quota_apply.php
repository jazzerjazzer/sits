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

    $quotaID = $_GET['quotaID'];
   	$compID = $_GET['compID'];
   	$userID = $_GET['userID'];
   

    $sql = "INSERT INTO application VALUES (DEFAULT, DEFAULT, \"not approved\", \"quotaApply\", NULL)";
	
	if ($conn->query($sql) == TRUE) {
	    $sql = "UPDATE quotaApply SET quotaID='$quotaID', compID = '$compID', studentID = '$userID' WHERE quotaID IS NULL AND compID IS NULL AND studentID IS NULL";
		if ($conn->query($sql) == TRUE) {
			header('location:quota.php?result=2');
		}else{
			header('location:quota.php?result=1');
		}
	} else {
	    echo "Error adding record: " . $conn->error;
		header('location:quota.php?result=1');
	}
?>