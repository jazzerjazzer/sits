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
    echo "'$quotaID'";
    echo "<br>";
 	$compID = $_GET['compID'];
    echo "'$compID'";
    echo "<br>";
 	$userID = $_GET['userID'];
    echo "'$userID'";
    echo "<br>";

    $sql = "INSERT INTO application VALUES (DEFAULT, DEFAULT, \"not approved\", \"quotaApply\", NULL)";
	
	if ($conn->query($sql) == TRUE) {
		echo "first success <br>";
	    $sql = "UPDATE quotaApply SET quotaID='$quotaID', compID = '$compID', studentID = '$userID' WHERE quotaID IS NULL AND compID IS NULL AND studentID IS NULL";
		if ($conn->query($sql) == TRUE) {
			echo "second success <br>";
			
			//header('location:quota.php?result=2');
		}else{
			echo "first fail <br>";
			//header('location:quota.php?result=1');
		}
	} else {
		echo "last fail <br>";
	    echo "Error adding record: " . $conn->error;
		header('location:quota.php?result=1');
	}
?>