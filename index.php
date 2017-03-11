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
  <link rel="stylesheet" href="style.css">
    
  <!-- Compiled and minified JavaScript -->
  <!--Import Google Icon Font-->
  <link href = "dist/css/bootstrap.min.css"/>
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
  <!-- <div class="jumbotron" id="top">
    <div class="container">
      <h1 class="text-center">Bloggy<br/><small><small class="hidden-xs pull-right">Express your thoughts</small></small></h1>
    </div>
  </div> --><!-- /jumbotron -->

  <div class="navbar-fixed ">
  <nav>
    <div class="nav-wrapper blue-grey">
      <a href="#!" class="brand-logo" style="text-decoration:none">Bloggy</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
      <li><a href="signup.php" class="btn waves-effect waves-light deep-orange lighten-2" style="padding-right:2em;text-decoration:none">Sign Up</a></li>
      <li><a href="login.php" class="btn waves-effect waves-light deep-orange lighten-2" style="padding-right:2em;text-decoration:none">Login</a></li>
      <li><a href="contactUs.php" class="btn waves-effect waves-light deep-orange lighten-2" style="padding-right:2em;text-decoration:none">Contact Us</a></li>
          </ul>
       <form style="margin-left: 200px;">
        <div class="input-field" style="max-width: 400pt;">
          <input id="search" type="search" required>
          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
          <i class="material-icons">close</i>
        </div>
      </form>
       <ul class="side-nav" id="mobile-demo">
         <li><a href="signup.php" style="text-decoration:none">Sign Up</a></li>
      <li><a href="login.php"  style="text-decoration:none">Login</a></li>
       <li><a href="conactUs.php"  style="text-decoration:none">Contact Us</a></li>
       </ul>
      </div>
      </nav>
      </div>
    <!-- <div class="container-fluid blue-grey valign-wrapper" style="height:50vh;">
  <div class="row">
  <div class="col s12 center-align">
  <h1 class="white-text main-title valign" >Bloggy</h1>
  <h3 class="sub-title white-text valign">-Express your thoughts</h3>
  </div>
  </div>
</div> -->
</body>
<?php

$viewer = new Viewer($conn);
$word_limit = '10';
$blog_id = "all";
$blogs = $viewer->get_all_blogs('',$blog_id);
if($blogs == false)
  {
    echo "<div class = 'container'><div class='alert alert-info text-center'>No blogs published yet!</div></div>";
  }
  else{
    $i=0;
    while($i < count($blogs)) {
    echo '<div class="row">
    <div class="col s12 m4" style="padding-left:2em;">
    <div class="card sticky-action medium">
    <div class="card-image  waves-effect waves-block waves-light">
              <img class = "activator" src="'.$viewer->get_blog_image($blogs[$i][0]).'">
            </div>
    <div class="card-content">
    <span class="card-title">'.$blogs[$i][2].'<p class="flow-text grey-text">'.$blogs[$i][4].','.$blogs[$i][6];
    if(!is_null($blogs[$i][7]))
    {
      echo ',Updated on '.$blogs[$i][7].'</p></span>';
    }

    echo '<h4 class="flow-text">'.$viewer->limit_words($blogs[$i][3],$word_limit).'......</h4></div>';

    echo '<div class = "text-center card-action"><a href ="view-blog.php?blog_id='.$blogs[$i][0].'" >Read More</a>
      by,<a href ="profile.php?username='.$blogs[$i][9].'">'.$blogs[$i][8].'</a>
      <a href = "view-blog.php?category='.$blogs[$i][4].'">'.$blogs[$i][4].'</a>
      </div>';
      echo '<div class="card-reveal"><span class="card-title">'.$blogs[$i][2].'<i class="material-icons right">close</i><h6 class="flow-text grey-text">'.$blogs[$i][4].','.$blogs[$i][6].'<br/></h6> </span><h4 class="flow-text">'.$blogs[$i][3].'</div>
      </div></div>';
    $i=$i+1;  
    }
    
  }
?>