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

				if(isset($_POST['filter'])){
					$city=$_POST['city'];
				}elseif(isset($_POST['search'])){
					$searchKey =$_POST['company_name'];
				}

				$sql="SELECT DISTINCT city FROM company order by city"; 
				$result = mysqli_query($conn, $sql);
				echo "<div class=\"menu_table_container\">";
				echo "<div class=\"menu_container\">";
				echo "<form method=\"post\" action=\"companyl.php\">";
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
				$viewQuery = "CREATE VIEW ReadOnlyCompanies AS
							SELECT compID, name, city, studentRating, evaluatorRating, applicableDepts, sector 
							FROM company NATURAL JOIN registeredCompany";
				$result = mysqli_query($conn, $viewQuery);

				$populateQuery = "SELECT * FROM ReadOnlyCompanies";
				
				if(strcmp($city, "") !== 0){
					if(strcmp($city, "All Companies") !== 0){
						$populateQuery = "SELECT * FROM ReadOnlyCompanies WHERE city='$city'";
					}
				}

				if(strcmp($searchKey, "") !== 0){
					$populateQuery = "SELECT * FROM ReadOnlyCompanies WHERE name LIKE '%$searchKey%'";
				}
				$populateQueryResult = mysqli_query($conn, $populateQuery);
				
				echo "<div class=\"table_container\">";
				if (mysqli_num_rows($populateQueryResult) > 0) {
				    // output data of each row
				    echo "<table class=\"company_table\">"; // start a table tag in the HTML
				    echo "<tr> <th>ID</th> <th>Name</th> <th>City</th> <th>Student Rating</th> <th>Evaluator Rating</th> <th>App Depts.</th> <th>Sector</th></tr>";
				    while($row = mysqli_fetch_assoc($populateQueryResult)) {
						echo "<tr><td>" . $row['compID'] . "</td><td>" . $row['name'] . "</td><td>" . $row['city'] . "</td><td>"
						. $row['studentRating'] . "</td><td>" . $row['evaluatorRating'] . "</td><td>" . $row['applicableDepts'] . "</td><td>" . $row['sector'] . 
						"</td></tr>";
				    }
				echo "</table>";
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
				<p> GUEST </p>
			</div>

			<div id="menu_buttons">
				<ul>
				  <li><a href="companyl.php" class="button-2">Companies</a></li>
				  <li><a href="general_announcementl.php" class="button-2">Anouncements</a></li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>
