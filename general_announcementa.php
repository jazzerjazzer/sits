<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />

	<style style="text/css">
	.announcement_table{
		width:100%; 
		border-collapse:collapse; 
		margin-top: 50px;
	}
	.announcement_table td{ 
		padding:7px; border:#4e95f4 1px solid;
	} 
	.announcement_table tr{
		background: #b8d1f3;
	}
	.announcement_table tr:hover {
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
	.nav_button {
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
	.nav_button:hover {
		background: #C46C28;
	}
	ul {
    	list-style-type: none;
    	margin: 0;
    	padding: 0;
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
	.table_container{
		width:99%;
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
			//get announcements from database and display
			$q = "SELECT title, message, date 
				FROM generalAnnouncement NATURAL JOIN announcement";
			
		  
			$res = mysqli_query($conn, $q);
			echo "<div class=\"table_container\">";
				if (mysqli_num_rows($res) > 0) {
				    // output data of each row
					echo "<table class=\"announcement_table\">";
				    echo "<tr> <th>title</th> <th>message</th> <th>date</th></tr>";
				    while($row = mysqli_fetch_assoc($res)) {
						echo "<tr><td>" . $row['title'] . "</td><td>" . $row['message'] . "</td><td>" . $row['date'] . "</td></tr>"; 
				    }
				echo "</table>"; // start a table tag in the HTML
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
					$userDept = $_SESSION["userDept"];

					echo "<p>$usr</p>";
					echo "<p>$userDept</p>";
				?>
				<p><a href='logout.php'>Logout</a></p>
			</div>

			<div id="menu_buttons">
				<ul>
				  <li><a href="quotaa.php" class="button-2">Quotas</a></li>
				  <li><a href="advisor_approve.php" class="button-2">Companies</a></li>
				  <li><a href="general_announcementa.php" class="button-2">Anouncements</a></li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>
