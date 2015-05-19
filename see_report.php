<html>

<head>
	<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script language="javascript">

		function validateForm(){
		  var a=document.forms["apply_form"]["start"].value;
		  var b=document.forms["apply_form"]["end"].value;

		  if (a==null || a=="",b==null || b==""){
		    alert("Please Fill All Fields!");
		    return false;
		  }
		}
	</script>
	<style style="text/css">

	.company_table{
		width:100%; 
		border-collapse:collapse; 
	}
	.company_table td{ 
		padding:7px; border:#4e95f4 1px solid;
	} 
	.company_table tr{
		background: #b8d1f3;
	}
	.company_table tr:hover {
		background-color: #ffffff;
	}

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
				<form action="" method="post" name="apply_form" class="apply_form"  onsubmit="return validateForm()"> 

				<form action="add_application.php" method="post">

				<label for="start" style="margin-left:-80px;">Start Date:</label>
				<input name = "start" type="date" style="margin-left:20px;"/>
				
				<label for="end" style="margin-left:-80px;" >End Date:</label>
				<input name = "end" type="date" style="margin-left:20px;" />
				
				
				<br>
				<br>
				<button type="submit" name="apply" action="#" style="margin-left:30px; margin-top:1px;">Get Report</button>
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

					
					
					if(isset($_POST['apply'])){
						
						$startDate = date('Y-m-d', strtotime($_POST['start']));
						$endDate = date('Y-m-d', strtotime($_POST['end']));
						
						$directApplyQuery = "SELECT count(*) as ccount FROM directApply NATURAL JOIN application
											WHERE (appSubmitDate BETWEEN '$startDate' AND '$endDate')";
						$directApplyQueryResult = mysqli_query($conn, $directApplyQuery);
						$directApplyQueryRow = mysqli_fetch_assoc($directApplyQueryResult);

						echo "<h3>Direct Application Report</h3>";
						echo "<hr>";
						echo "Total Number of Direct Applications Between " 
								. $startDate . " and " . $endDate ." is ". $directApplyQueryRow['ccount'];

						$directApplyCountQuery = "SELECT count(*) as ccount, name FROM directApply NATURAL JOIN application NATURAL JOIN company WHERE (appSubmitDate BETWEEN '$startDate' AND '$endDate') GROUP BY name";
						$directApplyCountQueryResult = mysqli_query($conn, $directApplyCountQuery );
						if (mysqli_num_rows($directApplyCountQueryResult) > 0) {
							echo "<table class=\"company_table\">"; 
							echo "<tr> <th>Company Name</th> <th>Direct Application Count</th></tr>";
							while($directApplyCountQueryRow = mysqli_fetch_assoc($directApplyCountQueryResult)) {
								echo "<tr><td>" . $directApplyCountQueryRow['name'] . "</td><td>" . $directApplyCountQueryRow['ccount']
									."</td></tr>"; 
							}
							echo "</table>";
						}


						/*******************QUOTA****************/
						$quotaApplyQuery = "SELECT count(*) as ccount FROM quotaApply NATURAL JOIN application
											WHERE (appSubmitDate BETWEEN '$startDate' AND '$endDate')";
						$quotaApplyQueryResult = mysqli_query($conn, $quotaApplyQuery);
						$quotaApplyQueryRow = mysqli_fetch_assoc($quotaApplyQueryResult);

						
						$quotaApplyCountQuery = "SELECT count(*) as ccount, name FROM quotaApply NATURAL JOIN application NATURAL JOIN company WHERE (appSubmitDate BETWEEN '$startDate' AND '$endDate') GROUP BY name";
						$quotaApplyCountQueryResult = mysqli_query($conn, $quotaApplyCountQuery );

						echo "<h3>Quota Application Report</h3>";
						echo "<hr>";
						echo "Total Number of Quota Applications Between " 
								. $startDate . " and " . $endDate ." is ". $quotaApplyQueryRow['ccount'];
						echo "<br>";

						if (mysqli_num_rows($quotaApplyCountQueryResult) > 0) {
							echo "<table class=\"company_table\">"; 
							echo "<tr> <th>Company Name</th> <th>Quota Application Count</th></tr>";
							while($quotaApplyCountQueryRow = mysqli_fetch_assoc($quotaApplyCountQueryResult)) {
								echo "<tr><td>" . $quotaApplyCountQueryRow['name'] . "</td><td>" . $quotaApplyCountQueryRow['ccount']
									."</td></tr>"; 
							}
							echo "</table>";
						}

					}
	            ?>
	            	</form>
			    </form>
			</div>
		</div>
		
		<div id="nav">
			<div id="user_info">
				<?php
					@session_start();
					$usr = $_SESSION["userID"];
					$userDept = $_SESSION["userDept"];
					$name = $_SESSION["name"];

					echo "<p>$name</p>";
					echo "<p>$userDept</p>";
				?>
				<p><a href='logout.php'>Logout</a></p>
			</div>
			<div id="menu_buttons">
				<ul>
					<li><a href="secretary_see_applications.php" class="button-2">Applications</a></li>
					<li><a href="quotas.php" class="button-2">Quotas</a></li>
					<li><a href="companys.php" class="button-2">Companies</a></li>
					<li><a href="general_announcements.php" class="button-2">Anouncements</a></li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>