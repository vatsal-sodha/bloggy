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
$word_limit = '10';
$blog_id = "all";
$blogs = $viewer->get_all_blogs($word_limit,$blog_id);
if($blogs == false)
  {
    echo "<div class = 'container'><div class='alert alert-info text-center'>No blogs published yet!</div></div>";
  }
  else{
    $i=0;
    while($i < count($blogs)) {
    echo '<div class="container">
    <div class="page-header">
    <h1>'.$blogs[$i][2].'<br/><small>'.$blogs[$i][4].','.$blogs[$i][6].'<br/>by,<a href ="profile.php?username='.$blogs[$i][9].'">'.$blogs[$i][8].'</a></small></h1>';
    if(!is_null($blogs[$i][7]))
    {
      echo '<h3><small>Updated on '.$blogs[$i][7].'</small></h3>';
    }

    echo '</div>
    <h4>'.$blogs[$i][3].'</h4>';

    echo '<div class = "text-center" style="background-color:#fffeff;opacity:0.7;width:inherit;text-decoration:none;"><a href ="view-blog.php?blog_id='.$blogs[$i][0].'" >Read More</a></div></div>';
    $i=$i+1;  
    }
    
  }
?>