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
  <title>Login</title>
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
     <script type="text/javascript">
        $(document ).ready(function(){
     $(".button-collapse").sideNav();
  })
  </script>  
</head>
<body style="font-family:'Lora',serif;">
 <div class="navbar-fixed ">
  <nav>
    <div class="nav-wrapper blue-grey">
      <a href="index.php" class="brand-logo" style="text-decoration:none">Bloggy</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
      <li><a href="signup.php" class="text-center btn waves-effect waves-light deep-orange lighten-2" style="padding-right:2em;text-decoration:none">Sign Up</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
       <li><a href="signup.php" style="text-decoration:none">Sign Up</a></li></ul>
    </div>
  </nav>
  </div>
<div class="container" style="width:50%">
  <h2>Login</h2>
  <div class="row col s12">
    <form class="col s12" method="post">
      <div class="row">
        <div class="input-field col s9">
          <input id="username" type="text" class="validate" name="username" autofocus required>
          <label for="username">Username</label>
        </div>
        </div>
   <div class="row">
        <div class="input-field col s9">
          <input id="pwd" name="password" type="password" class="validate" required>
          <label for="pwd">Password</label>
        </div>
      </div>
    <button class="btn waves-effect waves-light" type="submit" name="submit">Submit<i class="material-icons right">send</i>
    </button>
  </form>
</div>


<?php
if(isset($_POST['submit'])){


  echo "<script type=javascript> console.log('Connection established');</script>";
  $username=$_POST['username'];
  $password=$_POST['password'];
    
  
  $blogger = new Blogger($conn);
  if($username != "admin"){
  $login = $blogger->is_login($username,$password);
  if($login === true)
  {
    $_SESSION['username']=$username;
    header('Location:userhome.php');
    
  }
  if($login === false){
   echo '<div class="alert alert-danger" style="width:50%; margin-left:auto; margin-right:auto;"><center>Invalid Constraints</center></div>';
  }
  }
 else
  {
    $admin = new Admin($conn);
    $admin_login = $admin->is_login($username,$password);
    if($admin_login === true)
    {
      $_SESSION['admin']=$username;
      header('Location:admin-panel.php');
    }
    if($admin_login === false)
    {
      echo '<div class="alert alert-danger" style="width:50%; margin-left:auto; margin-right:auto;"><center>Invalid Constraints</center></div>';
    }
  }

  
}

?>
</body>
</html>
