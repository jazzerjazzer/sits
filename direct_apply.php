<html>

<head>
	<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

	<style style="text/css">


	#header {
		border-radius:10px;
		border: 5px solid #520052;
		margin-top: 15px;
		color:white;
	}
	#nav {
		padding-top: 15px;
		background-color:#838E91;
		height:500px;
		width:20%;
		float:left;
		margin-top:60px;
	}
	.button-2 {
		text-align:center;
		text-decoration: none;
		font-size: 120%;
		font-family: sans-serif;
		color: #FFF;
		-webkit-font-smoothing: antialiased;
		background: #EE8532;
		padding: 10px 20px;
		margin:5px 0px;
		display: inline-block;
		white-space: nowrap;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		border-radius: 2px;
		border: 2px solid rgba(255, 255, 255, 0.23);
		-moz-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.14);
		-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.14);
		box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.14);
		-webkit-transition: all 0.1s ease;
		-ms-transition: all 0.1s ease;
		-moz-transition: all 0.1s ease;
		-o-transition: all 0.1s ease;
		transition: all 0.1s ease;
		width:225px;
		height:50px;
	}
	.button-2:hover {
		background: #C46C28;
	}
	ul {
    	list-style-type: none;
    	margin: 0;
    	padding: 0;
	}
	

	#right_content_area{
		width:79%;
		margin-top:20px;
		float:right;
	}

	#container{
		width:99%;
		height:400px;
	}
	
	h1 {
 		text-align: center;
	}
	
	body{
		background-color:#00A4CE; 
	}

	#user_info{
		border: 5px solid #520052;
		color:white;
	}
	.company_details h2 {
		color:white;
		display: inline-block;
		vertical-align: middle;    
	}

	.company_details button {
		width: 100px;
		margin-top: 10px;
		margin-left: 500px;
		display: inline-block;
		vertical-align: middle;
	}
	#form {
	    background-color: #FFF;
	    height: 600px;
	    width: 600px;
	    margin-right: auto;
	    margin-left: auto;
	    margin-top: 0px;
	    border-top-left-radius: 10px;
	    border-top-right-radius: 10px;
	    padding: 0px;
	    text-align:center;
	}
	label {
	    font-family: Georgia, "Times New Roman", Times, serif;
	    font-size: 18px;
	    color: #333;
	    height: 20px;
	    width: 200px;
	    margin-top: 10px;
	    margin-left: 10px;
	    text-align: right;
	    clear: both;
	    float:left;
	    margin-right:15px;
	}
	input {
	    height: 20px;
	    width: 300px;
	    border: 1px solid #000;
	    margin-top: 10px;
	    float: left;
	}

</style>
	<body>
		<!-- Top part-->
		<div id="header">
			<img src="logo.jpg" width="65" height="65" align="left" vspace="2" hspace="5">
			<h1> Student Internship Tracking System </h1>
		</div> 
		

	<div id="container">
		<div id="right_content_area"> 
			<div class="company_details">
				<form action="" method="post" name="apply_form" class="apply_form">
				<h2>Company Details</h2>
				<button type="submit" name="apply" action="#">Apply</button>
				<hr>
			</div>
			<div id="company_form">
				<?php

					$servername = "localhost";
					$username = "root";
					$password = "comodo365";
					$dbname = "project";

					// Create connection
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					mysqli_set_charset($conn,"utf8");
					// Check connection
					if (!$conn) {
					    die("Connection failed: " . mysqli_connect_error());
					}

					$compID = $_GET['compID'];
					$sql = "SELECT name, address, sector, phone, city FROM company WHERE compID = '$compID'";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					echo "<h4>Name:</h4><h5>" . $row["name"] . "</h5>";
					echo "<h4>Address:</h4><h5>" . $row["address"] . "</h5>";
					echo "<h4>City:</h4><h5>" . $row["city"] . "</h5>";
					echo "<h4>Telephone:</h4><h5>" . $row["phone"] . "</h5>";
					echo "<h4>Sector:</h4><h5>" . $row["sector"] . "</h5>";
					echo "<h2>Internship Details</h2>";
					echo "<hr>";
					echo "<form action=\"add_application.php\" method=\"post\">";
					echo "<label for=\"start\">Start Date:</label>";
					echo "<input name = start type=\"date\" />";
					echo "<label for=\"end\">End Date:</label>";
					echo "<input name = end type=\"date\" />";
					echo "</form>";
					$userID = $_GET['userID'];
					
					if(isset($_POST['apply'])){
						
						$startDate = date('Y-m-d', strtotime($_POST['start']));
						$endDate = date('Y-m-d', strtotime($_POST['end']));
						
						$directApplyAmount = "SELECT appID FROM directApply WHERE studentID = '$userID'";
						$quotaApplyAmount = "SELECT appID FROM quotaApply WHERE studentID = '$userID'";
						
						$directApplyAmountResult = mysqli_query($conn, $directApplyAmount);
						$directApplyRows = mysqli_num_rows($directApplyAmountResult);

						$quotaApplyAmountResult = mysqli_query($conn, $quotaApplyAmount);
						$quotaApplyRows = mysqli_num_rows($quotaApplyAmountResult);

						if ($directApplyRows > 0 || $quotaApplyRows > 0) {

							echo "<script type=\"text/javascript\">\n";
							echo "if (confirm(\"Drop other applications?\") == true) {";
							
							$delQuota = "SELECT appID FROM quotaApply WHERE studentID = '$userID'";
							$delQuotaResult = mysqli_query($conn, $delQuota);
							if (mysqli_num_rows($delQuotaResult) > 0) {
						   
								while($delQuotaRow = mysqli_fetch_assoc($delQuotaResult)) {
									$deleteQuotas = "DELETE FROM application WHERE appID = '$delQuotaRow[appID]'";
									mysqli_query($conn, $deleteQuotas);
								}
							}

							if($directApplyRows == 0){
								$newDirectApply = "INSERT INTO application VALUES (DEFAULT, DEFAULT, \"not approved\", \"directApply\", NULL)";
								$updateNewDirectApply = "UPDATE directApply SET compID = '$compID', studentID = '$userID', 
								internshipStartDate = '$startDate', internshipEndDate = '$endDate', studentID = '$userID' WHERE studentID IS NULL AND compID IS NULL";
								
								mysqli_query($conn, $newDirectApply);
								mysqli_query($conn, $updateNewDirectApply);
							}else{
								$onlyUpdateDirectApply = "UPDATE directApply SET compID = '$compID', studentID = '$userID', 
									internshipStartDate = '$startDate', internshipEndDate = '$endDate', studentID = '$userID' WHERE studentID = '$userID'";
								
								mysqli_query($conn, $onlyUpdateDirectApply);
							}
							
							
						    echo "} else {";
						    echo "alert(\"NO\")";    
						    echo "}";
							echo "</script>\n\n";
						}else{
							$firstDirectApply = "INSERT INTO application VALUES (DEFAULT, DEFAULT, \"not approved\", \"directApply\", NULL)";
							
							if ($conn->query($firstDirectApply) == TRUE) {
							    $updateFirstDirectApply = "UPDATE directApply SET compID = '$compID', studentID = '$userID', internshipStartDate = '$startDate', internshipEndDate = '$endDate' WHERE compID IS NULL AND studentID IS NULL";
								
								if ($conn->query($updateFirstDirectApply) == TRUE) {
									$getAppID = "SELECT appID FROM directApply WHERE studentID = '$userID'";
									$appIDResult = mysqli_query($conn, $getAppID);
									$appIDRow = mysqli_fetch_assoc($appIDResult);
									$appID = $appIDRow['appID'];
									header('location:applications.php?result=6&appID='.$appID);
								}else{
									header('location:applications.php?result=3');
								}
							} else {
							    echo "Error adding record: " . $conn->error;
								header('location:application.php?result=3');
							}
						}
					}
	            ?>
			    </form>
			</div>
		</div>
		
		<div id="nav">
			<div id="user_info">
				<?php
					@session_start();
					$usr = $_SESSION["userID"];
					echo "<p>$usr</p>";
					echo "<p>CS</p>";
				?>
				<p>Logout</p>
			</div>
			<div id="menu_buttons">
				<ul>
					<li><a href="applications.php" class="button-2">My Applications</a></li>
					<li><a href="quota.php" class="button-2">Quotas</a></li>
					<li><a href="company.php" class="button-2">Companies</a></li>
					<li><a href="general_announcement.php" class="button-2">Anouncements</a></li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>