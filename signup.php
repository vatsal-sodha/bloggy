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
   <title>Sign Up</title>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
    
  <!-- Compiled and minified JavaScript -->
  <!--Import Google Icon Font-->
  <link href = "dist/css/bootstrap.min.css" rel="stylesheet" />
      <link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
       <script type="text/javascript" src="materialize/js/jquery-3.1.0.min.js"></script>
      <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
      <script type="text/javascript">
        $(document ).ready(function(){
     $(".button-collapse").sideNav();
  })
  </script>  
</head>
<body style="font-family:'Lora',serif;">
<nav>
    <div class="nav-wrapper blue-grey">
       <a href="index.php" class="brand-logo" style="text-decoration:none">Bloggy</a>
      <ul id ="nav-mobile" class="right hide-on-med-and-down">
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <li><a href="login.php" class="text-center btn waves-effect waves-light deep-orange lighten-2" style="padding-right:2em;text-decoration:none">Login</a></li>
      </ul>
       <ul class="side-nav" id="mobile-demo">
         <li><a href="login.php" style="text-decoration:none">Login</a></li>
       </ul>
    </div>
  </nav>
<div class="container" style="width:50%">
  <h2>Sign Up</h2>
  <div class="row">
    <form class="col s12" method="post">
      <div class="row">
        <div class="input-field col s12">
          <input id="firstname" type="text" class="validate" name="firstname" autofocus required>
          <label for="firstname">Firstname</label>
        </div>
        </div>

    <div class="row">
        <div class="input-field col s12">
          <input id="username" type="text" class="validate" name="username" required>
          <label for="username">Username</label>
        </div>
        </div>
    
    <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" class="validate" name="password" required>
          <label for="password">Password</label>
        </div>
        </div>
     <div class="form-group has-feedback" id="con_pwdiv">
      <label for="password">Confirm Password:</label>
      <input type="password" class="form-control" id="confirmpassword" onkeyup="validatepw()"><span id="con_pwspan" class="form-control-feedback glyphicon"></span>
    </div>
    
   <button class="btn waves-effect waves-light" type="submit" name="submit">Submit<i class="material-icons right">send</i>
    </button>
  </form>
</div>
<?php
if(isset($_POST['submit'])){


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
