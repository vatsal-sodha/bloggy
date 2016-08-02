<?php

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
  <link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
  <link href="dist/css/custom.css" rel="stylesheet">
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
      <li class="active"><a href="index.php">Home</a></li>
      
    </ul>
  <ul class="nav navbar-nav navbar-right">
      <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>

<?php
if(isset($_GET['username']))
{
$username = $_GET['username'];
$viewer = new Viewer($conn);
$profile = $viewer->get_blogger($username);
if($profile != false)
{
	echo '<h1 class = "text-center"> Blogs by '.$profile.' </h1>';
}
$profile = $viewer->profile($username);

if($profile != false)
{
	$i=0;
    while($i < count($profile)) {
    
    echo '<div class="container">
    <div class="page-header">
    <h1>'.$profile[$i][1].'<br/><small>'.$profile[$i][3].','.$profile[$i][4].'</small></h1>
    </div>
    <h4>'.$profile[$i][2].'</h4>
    </div>';
    $i=$i+1;  
    }
}

}
?>