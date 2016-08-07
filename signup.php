<?php
session_start();
include_once 'classes.php';
include_once 'connection.php';

if(isset($_SESSION['username']))
{
  header('Location:userhome.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Bloggy</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li></ul></div></nav>
<div class="container" style="width:50%">
  <h2>Sign Up</h2>
  <form role="form" method="post">
  	<div class="form-group" >
      <label for="name">First Name:</label>
      <input type="text" class="form-control" id="name" name="firstname" placeholder="Enter First Name">
    </div>

    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
    </div>
     <div class="form-group has-feedback" id="con_pwdiv">
      <label for="password">Confirm Password:</label>
      <div id="conf_pwd">
      <input type="password" class="form-control" id="confirmpassword" onkeyup="validatepw()" placeholder="Re-enter password"><span id="con_pwspan" class="form-control-feedback glyphicon"></span>
    </div>
    </div>
    
    <button type="submit" name="submit" onclick = "return validatepw();" class="btn btn-default">Submit</button>
  </form>
</div>
<?php
if(isset($_POST['submit'])){


  echo "Button pressed";
  $username=$_POST['username'];
  $password=$_POST['password'];
  $firstname=$_POST['firstname'];

    
  
  $blogger = new Blogger($conn);
  
  $signup = $blogger->is_signup($firstname,$username,$password);
  

  if($signup === true)
  {
    $_SESSION['username']=$username;
    echo $signup;
    header('Location:userhome.php');
    
  }
  if($signup === "Soory something went wrong"){
    echo '<div class="alert alert-danger" style="width:50%; margin-left:auto; margin-right:auto;"><center>Soory something went wrong</center></div>';
  }
  if($signup === "Username already exists"){
    echo '<div class="alert alert-danger" style="width:50%; margin-left:auto; margin-right:auto;"><center>Username is already registered!!</center></div>';
  }
}
?>
</body>
<script type="text/javascript">

function validatepw(){
  var pw = document.getElementById('password').value;
  var con_pw = document.getElementById('confirmpassword').value;
  var parent = document.getElementById('con_pwdiv');
  var span = document.getElementById('con_pwspan');

  if (pw != con_pw){
    // document.getElementById('conf_pwd').className = "bg-danger";
    parent.className = "form-group has-feedback has-error";
    span.className = "form-control-feedback glyphicon glyphicon-remove";
    console.log("Not equal");
    return false;
  }
  else{
    // document.getElementById('conf_pwd').className = "bg-success";
    parent.className = "form-group has-feedback has-success";
    span.className = "form-control-feedback glyphicon glyphicon-ok";
    return true;
  }
}
  
</script>
</html>
