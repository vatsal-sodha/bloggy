<?php
session_start();
// if(isset($_SESSION['admin']))
// {
//   header('Location:userhome.php');
// }
include_once 'classes.php';
include_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Blog</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
  <!--Import Google Icon Font-->
      <link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
</head>
<body style="font-family:'Lora',serif;">

<div class="container" style="width:50%">
  <h2>Welcome Admin</h2>
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


  $email=$_POST['username'];
  $password=$_POST['password'];
    
  
  $admin = new Admin($conn);
  
  $login = $admin->is_login($email,$password);
  

  if($login == true)
  {
    $_SESSION['admin']=$email;
    header('Location:admin-panel.php');
    
  }
  if($login == false){
   echo '<div class="alert alert-danger pagination-centered" style="width:50%; margin-left:auto; margin-right:auto;"><center>Invalid Constraints</center></div>';
  }
}

?>
</body>
</html>
