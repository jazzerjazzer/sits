<!DOCTYPE html>
<html lang="en"> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Student Internship Tracking System</title>
  <link rel="stylesheet" href="css/style.css">
  <script language="javascript">

    function validateForm(){
      var a=document.forms["Form"]["login"].value;
      var b=document.forms["Form"]["password"].value;
      
      if (a==null || a=="",b==null || b==""){
        alert("Please Fill All Required Field");
        return false;
      }
    }
  </script>
</head>
<body>

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

//check if the login form has been submitted
if(isset($_POST['login'])){
  $usr = mysqli_real_escape_string($conn, htmlentities($_POST['user_name']));
  $psw = $_POST['password'];  
    
  echo $usr;
  echo $psw;
  $q = "SELECT * FROM person WHERE name='$usr' AND password='$psw'";
  
  //step3: run the query and store result
  $res = mysqli_query($conn, $q);

  //make sure we have a positive result
  if(mysqli_num_rows($res) == 1){
    #########  LOGGING IN  ##########
    //starting a session  
        session_start();
        $_SESSION["user_name"] = $usr;
        //creating a log SESSION VARIABLE that will persist through pages   

    header('location:company.php');
  } else {
                //create an error message   
    $error = 'Wrong details. Please try again'; 
  }
}
?> 

  <section class="container">
    <div class="login">
      <h1>Login to SITS</h1>
      <form name="Form" method="post" onsubmit="return validateForm()" action="#">
        <p><input type="text" name="user_name" value="" placeholder="Username or Email"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        
        <p class="submit"><input type="submit" name="login" value="Login"></p>
      </form>
    </div>

    <div class="login-help">
      <p>Forgot your password? <a href="index.html">Click here to reset it</a>.</p>
      <p class="submit"><input type="button" name="announcements" value="Announcements" onClick="window.location = 'general_announcement.php';"></p>
      <p class="submit"><input type="button" name="companyList" value="Company List" onClick="window.location = 'company.php';"></p>
    </div>
  </section>
</body>
</html>