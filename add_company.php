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
				<form action="" method="post" name="comp_form" class="comp_form">
				<h2>Company Details</h2>
				<button type="submit" name="add" action="#">Add</button>
				<hr>
			</div>
			<div id="company_form">
			        <fieldset>
			            <label for="company_name">Name:</label>
			            <input name="company_name" />
			            <label for="country">Coüntry:</label>
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

							$sql="SELECT DISTINCT country FROM company order by country"; 
							$result = mysqli_query($conn, $sql);

							echo "<select id=\"country\" name=\"country\" style =\"float: left;\">"; 
							echo "<option selected=\"selected\"></option>";

							while ($row = mysqli_fetch_assoc($result)){
								echo '<option value='.$row['country'].'>'.$row['country'].'</option>';
							}
							echo "</select>"; 
							echo "<label for=\"city\">City:</label>";
				            $sql="SELECT DISTINCT city FROM company order by city"; 
							$result = mysqli_query($conn, $sql);
							echo "<select id=\"city\" name=\"city\" style =\"float: left;\">"; 
							echo "<option selected=\"selected\"></option>";

							while ($row = mysqli_fetch_assoc($result)){
								echo '<option value='.$row['city'].'>'.$row['city'].'</option>';
								
							}
							echo "</select>";
							if(isset($_POST['add'])){
								$city=$_POST['city'];
								$country=$_POST['country'];
								$name = $_POST['company_name'];
								$address = $_POST['address'];
								$telephone = $_POST['telephone'];
								$sector = $_POST['sector'];

								$sql = "INSERT INTO company VALUES (DEFAULT, 'asdasd', NULL, 'asdas', 'asdasd', NULL, \"not approved\", NULL, NULL,
								 'asdas', 'asdasd', NULL, NULL, 'asdasd')";
								$result = mysqli_query($conn, $sql);
								echo $result;
							}
						?>			            
						<label for="address">Address:</label>
			            <input name="address" />
			            <label for="telephone">Telephone:</label>
			            <input name="telephone" />
			            <label for="sector">Sector:</label>
			            <input name="sector" />
			        </fieldset>
			    </form>
			</div>
		</div>
		
		<div id="nav">
			<div id="user_info">
				<?php
					@session_start();
					$usr = $_SESSION["user_name"];
					echo "<p>$usr</p>";
					echo "<p>CS</p>";
				?>
				<p>Logout</p>
			</div>

			<div id="menu_buttons">
				<ul>
				  <li><a href="#" class="nav_button">My Applications</a></li>
				  <li><a href="#" class="nav_button">Quotas</a></li>
				  <li><a href="#" class="nav_button">Companies</a></li>
				  <li><a href="#" class="nav_button">Anouncements</a></li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>