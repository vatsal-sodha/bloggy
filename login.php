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

<div class="container" style="width:50%">
  <h2>Login</h2>
  <form role="form" method="post">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
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
  $email=$_POST['email'];
  $password=$_POST['password'];
    
  
  $blogger = new Blogger($conn);
  
  $login = $blogger->is_login($email,$password);
  

  if($login === true)
  {
    $_SESSION['username']=$email;
    header('Location:userhome.php');
    
  }
  if($login === false){
   echo '<div class="alert alert-danger"><center>Invalid Constraints</center></div>';
  }
}

?>
</body>
</html>
