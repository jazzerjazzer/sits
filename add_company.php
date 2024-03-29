<html>

<head>
	<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script language="javascript">

		function validateForm(){
		  var a=document.forms["comp_form"]["company_name"].value;
		  var b=document.forms["comp_form"]["address"].value;
		  var c=document.forms["comp_form"]["telephone"].value;
		  var d=document.forms["comp_form"]["sector"].value;

		  if (a==null || a=="",b==null || b=="",c==null || c=="",d==null || d==""){
		    alert("Please Fill All Fields!");
		    return false;
		  }
		}
	</script>
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
				<h2>Company Details</h2>
				<button type="submit" name="add" action="#">Add</button>
				<hr>
			</div>
			<div id="company_form">
			        <fieldset>
			            <label for="company_name">Name:</label>
			            <input name="company_name" />
			            <label for="country">Country:</label>
						<?php
							@session_start();
							$userDept = $_SESSION["userDept"];
							
							function generateRandomString($length = 8) {
							    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							    $charactersLength = strlen($characters);
							    $randomString = '';
							    for ($i = 0; $i < $length; $i++) {
							        $randomString .= $characters[rand(0, $charactersLength - 1)];
							    }
							    return $randomString;
							}

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
							$contFlag = 0;
							if(isset($_POST['add'])){
								$city=$_POST['city'];
								$country=$_POST['country'];
								$name = $_POST['company_name'];
								$address = $_POST['address'];
								$telephone = $_POST['telephone'];
								$sector = $_POST['sector'];
								$password = generateRandomString(8);

								$sql = "INSERT INTO company VALUES (DEFAULT, '$name', '$password', '$address', '$telephone', '$userDept', \"not approved\", NULL, NULL,
								 '$city', '$country', NULL, NULL, '$sector')";
								$result = mysqli_query($conn, $sql);
								$contFlag = 1;
							}
							echo "<label for=\"address\">Address:</label>";
					        echo "<input name=\"address\" />";
					        echo "<label for=\"telephone\">Telephone:</label>";
					        echo "<input name=\"telephone\" />";
					        echo "<label for=\"sector\">Sector:</label>";
					        echo "<input name=\"sector\" />";
						    echo "</fieldset>";
							echo "</form>";
							if($contFlag == 1)
								echo "Succesfully added!";
						?>			            
						
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