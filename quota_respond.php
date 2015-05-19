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
	$res = $_GET['res'];
	
	if($res == 1){
		$updateApproval = "UPDATE appFeedbackAnnouncement SET studentApproval = \"yes\" WHERE appID = '$appID'";
	}elseif($res == 0){
		$updateApproval = "UPDATE appFeedbackAnnouncement SET studentApproval = \"no\" WHERE appID = '$appID'";
	}
	mysqli_query($conn, $updateApproval);

	header('location:applications.php?result=5');
		
?>