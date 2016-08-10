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
  <!-- <div class="jumbotron" id="top">
    <div class="container">
      <h1 class="text-center">Bloggy<br/><small><small class="hidden-xs pull-right">Express your thoughts</small></small></h1>
    </div>
  </div> --><!-- /jumbotron -->

  <div class="navbar-fixed">
<nav>
    <div class="nav-wrapper white">
      <!-- <a href="#" class="brand-logo">Bloggy</a> -->
      <ul id ="nav-mobile" class="right hide-on-med-and-down">
      <li><a href="signup.php" class="btn waves-effect waves-light deep-orange lighten-2" style="padding-right:2em;text-decoration:none">Sign Up</a></li>
      <li><a href="login.php" class="btn waves-effect waves-light deep-orange lighten-2" style="padding-right:2em;text-decoration:none">Login</a></li>
      </ul>
      </div>
      </nav>
      </div>
    <div class="container-fluid blue-grey valign-wrapper" style="height:50vh;">
  <div class="row">
  <div class="col s12 center-align">
  <h1 class="white-text main-title valign" >Bloggy</h1>
  <h3 class="sub-title white-text valign">-Express your thoughts</h3>
  </div>
  </div>
</div>
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
    echo '<div class="row">
    <div class="col s12 m6 offset-m3">
    <div class="card-panel medium">
    <div class="card-content text-center">
    <span class="card-title"><h3>'.$blogs[$i][2].'</span><br/><small>'.$blogs[$i][4].','.$blogs[$i][6].'<br/>by,<a href ="profile.php?username='.$blogs[$i][9].'">'.$blogs[$i][8].'</a></small></h3>';
    if(!is_null($blogs[$i][7]))
    {
      echo '<h5><small>Updated on '.$blogs[$i][7].'</small></h5>';
    }

    echo '</div>
    <h4 class="flow-text">'.$blogs[$i][3].'......</h4>';

    echo '<div class = "text-center card-action" style="background-color:#fffeff;opacity:0.7;width:inherit;text-decoration:none;"><a href ="view-blog.php?blog_id='.$blogs[$i][0].'" >Read More</a></div></div>';
    $i=$i+1;  
    }
    
  }
?>