<!DOCTYPE html>
<html lang="en"> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Student Internship Tracking System</title>
  <link rel="stylesheet" href="css/style.css">
  <script language="javascript">

    function validateForm(){
      var a=document.forms["Form"]["userID"].value;
      var b=document.forms["Form"]["password"].value;
      
      if (a==null || a=="",b==null || b==""){
        alert("Please Fill All Fields!");
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
    $usr = mysqli_real_escape_string($conn, htmlentities($_POST['userID']));
    $psw = $_POST['password'];  
      
    $q = "SELECT * FROM person WHERE userID='$usr' AND password='$psw'";
    $department = "SELECT deptName FROM person WHERE userID = '$usr'";
    //step3: run the query and store result
    $res = mysqli_query($conn, $q);
    $resRow = mysqli_fetch_assoc($res);
    $userType =  $resRow['userType'];
    $name = $resRow['pName'];
    $surname = $resRow['surname'];
    $departmentRes = mysqli_query($conn, $department);
    $DeptRow = mysqli_fetch_assoc($departmentRes);
    $userDept =  $DeptRow['deptName'];
    echo $userType;
    //make sure we have a positive result
    if(mysqli_num_rows($res) == 1){
          session_start();
          $_SESSION["userDept"] = $userDept;
          $_SESSION["userID"] = $usr;
          $_SESSION["userType"] = $userType;
          $_SESSION["name"] = $name . " ". $surname;
          if(strcmp($userType, "student") == 0){
              header('location:company.php');
          }elseif(strcmp($userType, "secretary") == 0){
              header('location:companys.php');
          }elseif(strcmp($userType, "advisor") == 0){
              header('location:advisor_approve.php');
          }if(strcmp($userType, "company") == 0){
              $userDept = NULL;
              header('location:companyc.php');
          }
    } 
    else {
      $error = 'Wrong details. Please try again'; 
      echo $error;
    }
  }
?> 

  <section class="container">
    <div class="login">
      <h1>Login to SITS</h1>
      <form name="Form" method="post" onsubmit="return validateForm()" action="#">
        <p><input type="text" name="userID" value="" placeholder="UserID"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        
        <p class="submit"><input type="submit" name="login" value="Login"></p>
      </form>
    </div>

    <div class="login-help">

      <p class="submit"><input type="button" name="announcements" value="Announcements" onClick="window.location = 'general_announcementl.php';"></p>
      <p class="submit"><input type="button" name="companyList" value="Company List" onClick="window.location = 'companyl.php';"></p>
    </div>
  </section>
</body>
</html>