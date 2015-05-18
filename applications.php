<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />

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
	

	#companies{
		width:79%;
		margin-top:20px;
		float:right;
	}

	#container{
		width:99%;
		height:400px;
	}
	#but {
    	width: 150px;  height: 30px;
	}
	h1 {
 		text-align: center;
	}	
	body{
		background-color:#00A4CE; 
	}

	.menu_table_container {
		width:100%;
	}

	.menu_container {
		text-align: center;
		width:70%;
	}
	.table_container{
		width:99%;
	}
	.menu_comp {
		padding-left: 20px;
		display: inline-block;
		float:left;
	}
	.company_input{
		width:200px;
	}
	#user_info{
		border: 5px solid #520052;
		color:white;
	}
	
</style>
	<body>
		<!-- Top part-->
		<div id="header">
			<img src="logo.jpg" width="65" height="65" align="left" vspace="2" hspace="5">
			<h1> Student Internship Tracking System </h1>
		</div> 
		

	<div id="container">
		<div id="companies"> 
			<?php
				@session_start();
				$userID = $_SESSION["userID"];

				$servername = "localhost";
				$username = "root";
				$password = "comodo365";
				$dbname = "project";

				// Create connection
				$conn = mysqli_connect($servername, $username, $password, $dbname);
				// Check connection
				if (!$conn) {
				    die("Connection failed: " . mysqli_connect_error());
				}
				
				$sql = "SELECT quotaApply.appID, name, city, quotaDeadline, internshipDuration, qcount, quotaAmount, quota.status 
				FROM 
					(SELECT quotaID as quotaID, count(*) as qcount FROM quotaApply GROUP BY quotaID) as allAplications, quotaApply, quota, company 
					WHERE allAplications.quotaID = quota.quotaID AND company.compID = quota.compID = quotaApply.compID 
						AND studentID = '$userID' AND quotaApply.quotaID = allAplications.quotaID";
				
				$result_cancel_application = $_GET['result'];
				if($result_cancel_application == 2){
					echo "canceled succefully <br>";
				}elseif($result_cancel_application == 4){
					echo "updated succefully <br>";
				}elseif($result_cancel_application == 3){
					echo "direct apply error <br>";					
				}elseif($result_cancel_application == 6){
					echo "first apply success <br>";					
				}
				$result = mysqli_query($conn, $sql);
				echo "<div class=\"table_container\">";
				if (mysqli_num_rows($result) > 0) {
				    echo "<table class=\"company_table\">"; 
				    echo "<tr> <th>Company Name</th> <th>City</th> <th>Quota Deadline</th> <th>Training Period</th> <th>Total Applications</th> <th>Quota Amount</th> <th>Status</th> <th>Actions</th></tr>";
				    while($row = mysqli_fetch_assoc($result)) {
						echo "<tr><td>" . $row['name'] . "</td><td>" . $row['city'] . "</td><td>" . $row['quotaDeadline'] . "</td><td>"
						. $row['internshipDuration'] . "</td><td>" . $row['qcount'] . "</td><td>" . $row['quotaAmount'] . "</td><td>" . $row['status'] . 
						"</td><td>" ."<a href=quota_cancel.php?appID=". $row["appID"] . ">Cancel Application</a>"."</td></tr>";
				}
				
					echo "</table>"; 
				} else {
				    echo "0 results";
				}
				echo "</div>";
				mysqli_close($conn);
				
				?>  
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
