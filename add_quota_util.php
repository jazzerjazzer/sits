<html>

<head>
	<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
   
    <script language="javascript">

		function validateForm(){
		  var a=document.forms["comp_form"]["start"].value;
		  var b=document.forms["comp_form"]["end"].value;
		  var c=document.forms["comp_form"]["quota_deadline"].value;
		  var d=document.forms["comp_form"]["duration"].value;
		  var e=document.forms["comp_form"]["available_year"].value;
		  var f=document.forms["comp_form"]["quota_amount"].value;
		  var g=document.forms["comp_form"]["announcement_title"].value;
		  var h=document.forms["comp_form"]["message_area"].value;
		  var i=document.forms["comp_form"]["company_name"].value;		  

		  if (a==null || a=="",b==null || b=="", c==null || c=="",
		  	d==null || d=="", e==null || e=="", f==null || f=="", g==null || g=="", h==null || h=="",
		  	i==null || i==""){
		    alert("Please Fill All Fields!");
		    return false;
		  }
		}
	</script>
	
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
				<form action="" method="post" name="comp_form" class="comp_form" onsubmit="return validateForm()">
				<h2>Quota Details</h2>
				<button type="submit" name="add" action="#" >Add &#38; Announce</button>
				<hr>
			</div>
			<div id="company_form">
			        <fieldset>
			            <label for="company_name">Company Name:</label>
						<?php
							
							$servername = "localhost";
							$username = "root";
							$password = "comodo365";
							$dbname = "project";

							$userID = $_GET['userID'];

							// Create connection
							$conn = mysqli_connect($servername, $username, $password, $dbname);
							mysqli_set_charset($conn,"utf8");
							// Check connection
							if (!$conn) {
							    die("Connection failed: " . mysqli_connect_error());
							}

							$sql="SELECT name FROM company order by name"; 
							$result = mysqli_query($conn, $sql);
							echo "<br>";
							echo "<select id=\"company_name\" name=\"company_name\" style =\"float: left;\">"; 
							echo "<option selected=\"selected\"></option>";

							while ($row = mysqli_fetch_assoc($result)){
								echo '<option value='.$row['name'].'>'.$row['name'].'</option>';
							}
							echo "</select>";

							echo "<label for=\"start\">Start Date:</label>";
							echo "<input name = \"start\" type=\"date\" />";
							echo "<label for=\"end\">End Date:</label>";
							echo "<input name = \"end\" type=\"date\" />";
							
							echo "<label for=\"duration\">Duration:</label>";
			            	echo "<input name=\"duration\" />";

			            	echo "<label for=\"available_year\">Available Year:</label>";
			            	echo "<input name=\"available_year\" />";

			            	echo "<label for=\"quota_amount\">Quota Amount:</label>";
			            	echo "<input name=\"quota_amount\" />";

			            	echo "<label for=\"quota_deadline\">Quota Deadline:</label>";
							echo "<input name = \"quota_deadline\" type=\"date\" />";

			            	echo "<br><br>";
							echo "<label for=\"announcement_title\">Announcement Title:</label>";
			            	echo "<input name=\"announcement_title\" />";
			            	echo "<label for=\"message_area\">Announcement Message:</label>";
			            	
							if(isset($_POST['add'])){
								
								$startDate = date('Y-m-d', strtotime($_POST['start']));
								$endDate = date('Y-m-d', strtotime($_POST['end']));
								$deadline = date('Y-m-d', strtotime($_POST['quota_deadline']));
								
								$duration=$_POST['duration'];
								$availableYear=$_POST['available_year'];
								$quotaAmount = $_POST['quota_amount'];
								$announcementTitle = $_POST['announcement_title'];
								$announcementMessage = $_POST['message_area'];
								$companyName = $_POST['company_name'];

								$addAnnQuery = "INSERT INTO announcement VALUES (DEFAULT, DEFAULT, \"general\")";
								mysqli_query( $conn, $addAnnQuery );

								$lastID = mysqli_insert_id($conn);

								$addGenAnnQuery = "INSERT INTO generalAnnouncement VALUES ('$lastID', '$announcementTitle', 
									'$announcementMessage', '$userID')";
								mysqli_query( $conn, $addGenAnnQuery );

								$findCompID = "SELECT compID FROM company  WHERE name = '$companyName'";
								$findCompIDResult = mysqli_query( $conn, $findCompID );
								$row = mysqli_fetch_assoc($findCompIDResult);
								$compID = $row['compID'];
								$addQuotaQuery = "INSERT INTO quota VALUES (DEFAULT, '$lastID', '$compID', $duration, 
									'$startDate', '$endDate', '$availableYear', \"waiting for first drawal\", 
									'$quotaAmount', '$deadline')";
								mysqli_query( $conn, $addQuotaQuery);

							}
						?>		
					</fieldset>
					<textarea name="message_area" rows="4" cols="40" style="margin-left:230px; margin-top:1px;">
					</textarea>
			    </form>
			</div>
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