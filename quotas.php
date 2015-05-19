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
			<div id="right_content_area"> 
				<?php
					@session_start();
					$userID = $_SESSION["userID"];

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

					$directApplyAmount = "SELECT appID FROM directApply WHERE studentID = '$userID'";
					$directApplyAmountResult = mysqli_query($conn, $directApplyAmount);
					$directApplyRows = mysqli_num_rows($directApplyAmountResult);

					$sql="SELECT DISTINCT city FROM company order by city"; 
					$result = mysqli_query($conn, $sql);
					
					$appliedQuotas ="SELECT quotaID FROM quotaApply WHERE studentID = '$userID'"; 
					$appliedQuotaResult =mysqli_query($conn, $appliedQuotas);
					
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
					
					echo "</div>";

					$sql2 = "SELECT c.name, c.city, q.quotaID, q.compID, q.internshipStartDate, q.internshipEndDate, q.availableYears, q.status, q.quotaAmount, q.quotaDeadline
							FROM quota as q, company as c
							WHERE q.quotaID NOT IN(SELECT aa.quotaID
													FROM (SELECT quotaID as quotaID, count(*) as qcount
										  				  FROM quotaApply 
										 				  GROUP BY quotaID) as aa) AND q.compID = c.compID"; 

					$sql = "SELECT quota.quotaID, company.compID,name, city, quotaDeadline, internshipStartDate, internshipEndDate, qcount, quotaAmount, quota.status, availableYears  
							FROM (SELECT quotaID as quotaID, count(*) as qcount
	  								FROM quotaApply 
	  								GROUP BY quotaID) as allAplications, quota,company, opens
							WHERE allAplications.quotaID = quota.quotaID = opens.quotaID
								AND company.compID = quota.compID = opens.compID";
					
					
					if(strcmp($city, "") !== 0){
						if(strcmp($city, "All Companies") !== 0){
							$sql2 = "SELECT c.name, c.city, q.quotaID, q.compID, q.internshipStartDate, q.internshipEndDate, q.availableYears, q.status, q.quotaAmount, q.quotaDeadline
									FROM quota as q, company as c
									WHERE q.quotaID NOT IN(SELECT aa.quotaID
															FROM (SELECT quotaID as quotaID, count(*) as qcount
												  				  FROM quotaApply 
												 				  GROUP BY quotaID) as aa) AND q.compID = c.compID AND city = '$city'"; 

							$sql = "SELECT quota.quotaID, company.compID,name, city, quotaDeadline, internshipStartDate, internshipEndDate, qcount, quotaAmount, quota.status, availableYears  
									FROM (SELECT quotaID as quotaID, count(*) as qcount
			  								FROM quotaApply 
			  								GROUP BY quotaID) as allAplications, quota,company, opens
									WHERE allAplications.quotaID = quota.quotaID = opens.quotaID
										AND company.compID = quota.compID = opens.compID AND city = '$city'";
						}
					}
					$result = mysqli_query($conn, $sql);
					$result2 = mysqli_query($conn, $sql2);

					echo "<div class=\"table_container\">";
					echo "<table class=\"company_table\">"; 
					echo "<tr> <th>ID </th> <th>Name</th> <th>City</th> <th>Quota Deadline</th> <th>Start Date</th> <th>End Date</th> <th>Total Applications</th> <th>Quota Amount</th> <th>Status</th> <th>Available Years</th></tr>";
					$flag = 0;
					if (mysqli_num_rows($result) > 0) {

					    while($row = mysqli_fetch_assoc($result)) {
					    	while($row3 = mysqli_fetch_assoc($appliedQuotaResult)){
					    		if($row['quotaID'] == $row3['quotaID']){
					    			$flag = 1;
					    			break; 
					    		}else{
					    			$flag = 0;
					    		}
					    	}
					    	if ($flag == 1){
					    		echo "<tr><td>" . $row['quotaID'] . "</td><td>" . $row['name'] . "</td><td>" . $row['city'] . "</td><td>" . $row['quotaDeadline'] . "</td><td>"
								. $row['internshipStartDate'] . "</td><td>" . $row['internshipEndDate'] . "</td><td>" . $row['qcount'] . "</td><td>" . $row['quotaAmount'] . "</td><td>" . $row['status'] . "</td><td>".  $row['availableYears'] . 
									"</td></tr>"; 
							}else{
								if($directApplyRows > 0){
									if(strcmp($row['status'], "waiting for student approval") == 0){
										echo "<tr><td>" . $row['quotaID'] . "</td><td>" . $row['name'] . "</td><td>" . $row['city'] . "</td><td>" . $row['quotaDeadline'] . "</td><td>"
										. $row['internshipStartDate'] . "</td><td>" . $row['internshipEndDate'] . "</td><td>" . $row['qcount'] . "</td><td>" . $row['quotaAmount'] . "</td><td>" . $row['status'] . "</td><td>".  $row['availableYears'] . 
											"</td><td>"."N/A"."</td></tr>"; 
									}else{
										echo "<tr><td>" . $row['quotaID'] . "</td><td>" . $row['name'] . "</td><td>" . $row['city'] . "</td><td>" . $row['quotaDeadline'] . "</td><td>"
										. $row['internshipStartDate'] . "</td><td>" . $row['internshipEndDate'] . "</td><td>" . $row['qcount'] . "</td><td>" . $row['quotaAmount'] . "</td><td>" . $row['status'] . "</td><td>".  $row['availableYears'] . 
											"</td></tr>"; 
									}
								}else{
									if(strcmp($row['status'], "waiting for student approval") == 0){
										echo "<tr><td>" . $row['quotaID'] . "</td><td>" . $row['name'] . "</td><td>" . $row['city'] . "</td><td>" . $row['quotaDeadline'] . "</td><td>"
										. $row['internshipStartDate'] . "</td><td>" . $row['internshipEndDate'] . "</td><td>" . $row['qcount'] . "</td><td>" . $row['quotaAmount'] . "</td><td>" . $row['status'] . "</td><td>".  $row['availableYears'] . 
											"</td></tr>"; 
									}else{
										echo "<tr><td>" . $row['quotaID'] . "</td><td>" . $row['name'] . "</td><td>" . $row['city'] . "</td><td>" . $row['quotaDeadline'] . "</td><td>"
										. $row['internshipStartDate'] . "</td><td>" . $row['internshipEndDate'] . "</td><td>" . $row['qcount'] . "</td><td>" . $row['quotaAmount'] . "</td><td>" . $row['status'] . "</td><td>".  $row['availableYears'] . 
											"</td></tr>"; 
									}
								}
							}
							mysqli_data_seek($appliedQuotaResult, 0);
					    }
					}
					if(mysqli_num_rows($result2) > 0){
						
						while($row = mysqli_fetch_assoc($result2)) {
							if($directApplyRows > 0){
								if(strcmp($row['status'], "waiting for student approval") == 0){
									echo "<tr><td>" . $row['quotaID'] . "</td><td>" . $row['name'] . "</td><td>" . $row['city'] . "</td><td>" . $row['quotaDeadline'] . "</td><td>"
										. $row['internshipStartDate'] . "</td><td>" . $row['internshipEndDate'] . "</td><td>" . "0" . "</td><td>" . $row['quotaAmount'] . "</td><td>" . $row['status'] . "</td><td>".  $row['availableYears'] . 
										"</td></tr>"; 
								}else{
									echo "<tr><td>" . $row['quotaID'] . "</td><td>" . $row['name'] . "</td><td>" . $row['city'] . "</td><td>" . $row['quotaDeadline'] . "</td><td>"
										. $row['internshipStartDate'] . "</td><td>" . $row['internshipEndDate'] . "</td><td>" . "0" . "</td><td>" . $row['quotaAmount'] . "</td><td>" . $row['status'] . "</td><td>".  $row['availableYears'] . 
										"</td></tr>"; 
								}
								
							}else{
								if(strcmp($row['status'], "waiting for student approval") == 0){
									echo "<tr><td>" . $row['quotaID'] . "</td><td>" . $row['name'] . "</td><td>" . $row['city'] . "</td><td>" . $row['quotaDeadline'] . "</td><td>"
										. $row['internshipStartDate'] . "</td><td>" . $row['internshipEndDate'] . "</td><td>" . "0" . "</td><td>" . $row['quotaAmount'] . "</td><td>" . $row['status'] . "</td><td>".  $row['availableYears'] . 
										"</td></tr>"; 
								}else{
									echo "<tr><td>" . $row['quotaID'] . "</td><td>" . $row['name'] . "</td><td>" . $row['city'] . "</td><td>" . $row['quotaDeadline'] . "</td><td>"
										. $row['internshipStartDate'] . "</td><td>" . $row['internshipEndDate'] . "</td><td>" . "0" . "</td><td>" . $row['quotaAmount'] . "</td><td>" . $row['status'] . "</td><td>".  $row['availableYears'] . 
										"</td></tr>"; 
								}
							}
					    }
					}
					echo "</table>"; 
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
					$userDept = $_SESSION["userDept"];

					echo "<p>$usr</p>";
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
