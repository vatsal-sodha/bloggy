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
  <h2>Login</h2>
  <form role="form" method="post">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter password" required>
    </div>
    
    <button type="submit" name="submit" class="btn btn-default">Submit</button>
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
  if($username === "admin")
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
