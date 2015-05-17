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
	
	</style>
	<body>
		<!-- Top part-->
		<div id="header">
			<img src="logo.jpg" width="65" height="65" align="left" vspace="2" hspace="5">
			<h1> Student Internship Tracking System </h1>
		</div> 
		

		<div id="container">
			<div id="right_content_area"> 
				<?php
					@session_start();
					$usr = $_SESSION["user_name"];

					$servername = "localhost";
					$username = "root";
					$password = "comodo365";
					$dbname = "project";

					$result_close_exec = $_GET['result'];

					if($result_close_exec == 2){
						echo "<br> applied successfuly!";
					}else if($result_close_exec == 1){
						echo "<br> cannot applied!";
					}

					// Create connection
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					// Check connection
					if (!$conn) {
					    die("Connection failed: " . mysqli_connect_error());
					}

					if(isset($_POST['filter'])){
						$city=$_POST['city'];
					}
					$sql="SELECT DISTINCT city FROM company order by city"; 
					$result = mysqli_query($conn, $sql);
					echo "<div class=\"menu_table_container\">";
					echo "<div class=\"menu_container\">";
					echo "<form method=\"post\" action=\"quota.php\">";
					echo "<div class=\"menu_comp\">";
					echo "<select id=\"city\" name=\"city\" >"; 
	 				echo "<option selected=\"selected\">All Companies</option>";

					while ($row = mysqli_fetch_assoc($result)){
						echo '<option value='.$row['city'].'>'.$row['city'].'</option>';
					}
					echo "</select>"; 
					echo "</div>";

					echo "<div class=\"menu_comp\">";
					echo "<button type=\"submit\" name=\"filter\">Filter</button>";				
					echo "</div>";
					echo "<div class=\"menu_comp\">";
					echo "<label for=\"company_input\">Company Name</label>";
					echo "<input type=\"text\" id=\"company_input\" name=\"company_name\" value=\"\">";
					echo "</div>";
					echo "<div class=\"menu_comp\">";
					echo "<button type=\"submit\" name=\"search\">Search</button>";
					echo "</div>";
					echo "</div>";
					$sql = "SELECT quota.quotaID, company.compID,name, city, quotaDeadline, internshipStartDate, internshipEndDate, qcount, quotaAmount, 
							quota.status, availableYears
							FROM (SELECT quotaID as quotaID, count(*) as qcount, compID as compID
							FROM quotaApply
							GROUP BY quotaID) as allAplications, quota, opens, company
							WHERE allAplications.compID = quota.compID = opens.compID = company.compID";
							
					
					if(strcmp($city, "") !== 0){
						if(strcmp($city, "All Companies") !== 0){
							$sql = "SELECT quota.quotaID, company.compID,name, city, quotaDeadline, internshipStartDate, internshipEndDate, qcount, quotaAmount, 
								quota.status, availableYears
								FROM (SELECT quotaID as quotaID, count(*) as qcount, compID as compID
								FROM quotaApply
								GROUP BY quotaID) as allAplications, quota, opens, company
								WHERE allAplications.compID = quota.compID = opens.compID = company.compID AND company.city='$city'";
						}
					}
					$result = mysqli_query($conn, $sql);
					$zeroResult = FALSE;
					if(mysqli_num_rows($result) == 0){
						$sql = "SELECT quota.quotaID, company.compID,name, city, quotaDeadline, internshipStartDate, internshipEndDate, quotaAmount, 
							quota.status, availableYears
							FROM quota, opens, company
							WHERE quota.compID = opens.compID = company.compID";
						if(strcmp($city, "") !== 0){
							if(strcmp($city, "All Companies") !== 0){
								$sql = "SELECT quota.quotaID, company.compID,name, city, quotaDeadline, internshipStartDate, internshipEndDate, quotaAmount, 
									quota.status, availableYears
									FROM quota, opens, company
									WHERE quota.compID = opens.compID = company.compID AND company.city='$city'";
							}
						}	
						$zeroResult = TRUE;
					}
					echo "<div class=\"table_container\">";
					$result = mysqli_query($conn, $sql);
					if (mysqli_num_rows($result) > 0) {

					    echo "<table class=\"company_table\">"; 
					    echo "<tr> <th>Name</th> <th>City</th> <th>Quota Deadline</th> <th>Start Date</th> <th>End Date</th> <th>Total Applications</th> <th>Quota Amount</th> <th>Status</th> <th>Available Years</th><th>Actions</th></tr>";
					    while($row = mysqli_fetch_assoc($result)) {
					    	if(!$zeroResult)
								echo "<tr><td>" . $row['name'] . "</td><td>" . $row['city'] . "</td><td>" . $row['quotaDeadline'] . "</td><td>"
								. $row['internshipStartDate'] . "</td><td>" . $row['internshipEndDate'] . "</td><td>" . $row['qcount'] . "</td><td>" . $row['quotaAmount'] . "</td><td>" . $row['status'] . "</td><td>".  $row['availableYears'] . 
									"</td><td>"."<a href=quota_apply.php?quotaID=". $row["quotaID"] . "&compID=". $row["compID"] . "&userID=".$_SESSION["userID"]. ">Apply</a>"."</td></tr>"; 
							else
								echo "<tr><td>" . $row['name'] . "</td><td>" . $row['city'] . "</td><td>" . $row['quotaDeadline'] . "</td><td>"
								. $row['internshipStartDate'] . "</td><td>" . $row['internshipEndDate'] . "</td><td>" . "0" . "</td><td>" . $row['quotaAmount'] . "</td><td>" . $row['status'] . "</td><td>".  $row['availableYears'] . 
									"</td><td>"."<a href=quota_apply.php?quotaID=". $row["quotaID"] . "&compID=". $row["compID"] . "&userID=".$_SESSION["userID"]. ">Apply</a>"."</td></tr>"; 

					    }
					echo "</table>"; // start a table tag in the HTML
					} else {
					    echo "0 results";
					}
					echo "</div>";
					echo "</div>";
					mysqli_close($conn);
				?>  
				</form>
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
