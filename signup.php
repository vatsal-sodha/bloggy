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
  <h2>Sign Up</h2>
  <form role="form" method="post">
  	<div class="form-group" >
      <label for="name">First Name:</label>
      <input type="text" class="form-control" id="name" name="firstname" placeholder="Enter First Name">
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
    </div>
     <div class="form-group">
      <label for="password">Confirm Password:</label>
      <input type="password" class="form-control" id="confirmpassword" placeholder="Re-enter password">
    </div>
    
    <button type="submit" name="submit" class="btn btn-default">Submit</button>
  </form>
</div>
<?php
if(isset($_POST['submit'])){


  echo "Button pressed";
  $email=$_POST['email'];
  $password=$_POST['password'];
  $firstname=$_POST['firstname'];

    
  
  $blogger = new Blogger($conn);
  
  $signup = $blogger->is_signup($firstname,$email,$password);
  

  if($signup === true)
  {
    $_SESSION['username']=$email;
    echo $signup;
    header('Location:userhome.php');
    
  }
  if($signup === "Soory something went wrong"){
    echo "<p class='danger'>Invalid Constraints</p>"; 
  }
  if($signup === "Username already exists"){
    echo '<div class="alert alert-danger"><center>Username is already registered!!</center></div>';
  }
}
?>
</body>
</html>