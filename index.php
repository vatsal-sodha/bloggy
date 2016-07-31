<?php
session_start();
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
  <div class="jumbotron" id="top">
    <div class="container">
      <h1 class="text-center">Bloggy<br/><small><small class="hidden-xs pull-right">Express your thoughts</small></small></h1>
    </div>
  </div><!-- /jumbotron -->

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Bloggy</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      
    </ul>
  <ul class="nav navbar-nav navbar-right">
      <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>
</body>
<?php

$viewer = new Viewer($conn);

$blogs = $viewer->get_all_blogs();
if($blogs == false)
  {
    echo "<div class = 'container'><div class='alert alert-info text-center'>No blogs published yet!</div></div>";
  }
  else{
    $i=0;
    while($i < count($blogs)) {
    
    echo '<div class="container">
    <div class="page-header">
    <h1>'.$blogs[$i][2].'<br/><small>'.$blogs[$i][4].','.$blogs[$i][6].'</small></h1>
    </div>
    <h4>'.$blogs[$i][3].'</h4>
    </div>';
    $i=$i+1;  
    }
    
  }
?>