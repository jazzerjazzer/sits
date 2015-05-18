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
	$studentID = $_GET['studentID'];
	$secID = $_GET['secID'];
	
	$createAnn = "INSERT INTO announcement VALUES (DEFAULT, DEFAULT, NULL)";
	mysqli_query($conn, $createAnn);
	$getAppID = "SELECT announcementID FROM announcement WHERE announcementType IS NULL";
	$getAppIDResult = mysqli_query($conn, $getAppID);
	$getAppIDRow = mysqli_fetch_assoc($getAppIDResult);
	$annAppID = $getAppIDRow['announcementID'];
	echo "annAppID ". $annAppID. "<br>";
	$annUpdate = "UPDATE announcement SET announcementType = \"feedback\" WHERE announcementType IS NULL";
	mysqli_query($conn, $annUpdate);
	$createFBAnn = "INSERT INTO appFeedbackAnnouncement VALUES ('$annAppID', NULL, \"04/07/15\", '$secID', '$studentID', '$appID')";
	mysqli_query($conn, $createFBAnn);
	$annStateUpdate = "UPDATE quotaApply SET announced = 1 WHERE appID = '$appID'";
	mysqli_query($conn, $annStateUpdate);

	header('location:secretary_see_applications.php?result=2');
		
?>