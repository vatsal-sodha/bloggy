<?php
session_start();
if(isset($_SESSION['admin']))
{
  header('Location:userhome.php');
}
include_once 'classes.php';
include_once 'connection.php';
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
  

  if($login === true)
  {
    $_SESSION['admin']=$username;
    header('Location:admin-panel.php');
    
  }
  if($login === false){
   echo '<div class="alert alert-danger pagination-centered" style="width:50%; margin-left:auto; margin-right:auto;"><center>Invalid Constraints</center></div>';
  }
}

?>
</body>
</html>
