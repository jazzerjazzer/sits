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
   	$da = $_GET['da'];
   	$cont = 0;
   	if($da == 0){
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
	}else{
		echo "<script type=\"text/javascript\">\n";
		echo "if (confirm(\"Drop other applications?\") == true) {";
		$sql = " SELECT appID FROM directApply WHERE studentID = '$userID'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$appID = $row['appID'];
		$sql = "DELETE FROM application WHERE appID = '$appID'";
		mysqli_query($conn, $sql);

		$sql = "INSERT INTO application VALUES (DEFAULT, DEFAULT, \"not approved\", \"quotaApply\", NULL)";

		if ($conn->query($sql) == TRUE) {
			$sql = "UPDATE quotaApply SET quotaID='$quotaID', compID = '$compID', studentID = '$userID' 
					WHERE quotaID IS NULL AND compID IS NULL AND studentID IS NULL";
			mysqli_query($conn, $sql);
			echo "window.location=\"quota.php?result=2\"";
		} 

		echo "} else {";
		echo "alert(\"NO\")";    
		echo "}";
		echo "</script>\n\n";
		/*if($cont == 1)
			header('location:quota.php?result=2');*/
	}
?>