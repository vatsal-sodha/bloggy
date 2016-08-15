<?php
session_start();
include_once 'classes.php';
include_once 'connection.php';
$username=$_SESSION['username'];
$blogger = new Blogger($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
  <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>  
      <script type="text/javascript">
        $(document ).ready(function(){
     $(".button-collapse").sideNav();
  })
      </script>
</head>
<body style="font-family:'Lora',serif;">
<div class="navbar-fixed ">
  <nav>
    <div class="nav-wrapper blue-grey">
      <a href="#!" class="brand-logo" style="text-decoration:none">Bloggy</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
      <li><a href="write-blog.php" class="btn waves-effect waves-light deep-orange lighten-2" style="padding-right:2em;text-decoration:none">Write</a></li>
      <li><a href="userhome.php?logout" class="btn waves-effect waves-light deep-orange lighten-2" style="padding-right:2em;text-decoration:none">Logout</a></li>
      </ul>
       <ul class="side-nav" id="mobile-demo">
         <li><a href="write-blog.php" style="text-decoration:none">Write</a></li>
      <li><a href="userhome.php?logout"  style="text-decoration:none">Logout</a></li></ul>
      </div>
      </nav>
      </div>
<?php

if(isset($_GET['logout']))
{
  
  $blogger->blogger_logout();
}


$blogs = $blogger->get_blog($username);
$viewer = new Viewer($conn);

if($blogs == false)
  {
    echo "<div class = 'container' style='padding-top:1em;'><div class='alert alert-info text-center'>No blogs published yet!</div></div>";
  }
  else{
    $i=0;
    while($i < count($blogs)) {
    $word_limit = '10';
    echo '<div class="row">
    <div class="col s12 m4" style="padding-left:2em;">
    <div class="card sticky-action medium">
    <div class="card-image  waves-effect waves-block waves-light">
              <img class = "activator" src="'.$viewer->get_blog_image($blogs[$i][0]).'">
            </div>
    <div class="card-content">
    <span class="card-title">'.$blogs[$i][1].'<h6 class="flow-text grey-text">'.$blogs[$i][3].','.$blogs[$i][4];
    if(!is_null($blogs[$i][5]))
    {
      echo ',Updated on '.$blogs[$i][5].'</h6></span>';
    }
     echo '<h4 class="flow-text">'.$viewer->limit_words($blogs[$i][2],$word_limit).'......</h4></div>';
     echo '<div class = "text-center card-action">
      <a href = "update.php?blog_id='.$blogs[$i][0].'">update</a><a href ="view-blog.php?blog_id='.$blogs[$i][0].'&username='.$username.'" >Read More</a></div>';

      echo '<div class="card-reveal"><span class="card-title">'.$blogs[$i][1].'<i class="material-icons right">close</i><h6 class="flow-text grey-text">'.$blogs[$i][3].','.$blogs[$i][4].'<br/></h6> </span><h4 class="flow-text">'.$blogs[$i][2].'</div></div></div>';
    $i=$i+1;  
    }
    
  }
?>
</body>
</html>