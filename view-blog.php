<?php
include_once 'classes.php';
include_once 'connection.php';
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
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
  <!--Import Google Icon Font-->
   <link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
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
      <a href="index.php" class="brand-logo" style="text-decoration:none">Bloggy</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
       <ul class="right hide-on-med-and-down" <?php if(!isset($_GET['username'])){?>>
      <li><a href="signup.php" class =  "btn waves-effect waves-light deep-orange lighten-2">Sign Up</a></li>
      <li><a href="login.php" class =  "btn waves-effect waves-light deep-orange lighten-2">Login</a></li></ul>
      <?php }?>
      <ul class="right hide-on-med-and-down" <?php if(isset($_GET['username'])){?>>
      <li><a href="write-blog.php" class =  "btn waves-effect waves-light deep-orange lighten-2">Write</a></li>
      <li><a href="userhome.php?logout" class =  "btn waves-effect waves-light deep-orange lighten-2">Logout</a></li></ul><?php } ?> 
       <ul class="side-nav" id="mobile-demo" <?php if(!isset($_GET['username'])){?>>
       	<li><a href="signup.php" >Sign Up</a></li>
      <li><a href="login.php" >Login</a></li>
      <?php }?></ul>
      <ul class="side-nav" id="mobile-demo" <?php if(isset($_GET['username'])){?>>
       	<li><a href="write-blog.php" >Write</a></li>
      <li><a href="userhome.php?logout" >Logout</a></li>
      <?php }?></ul>

    
</div>
  </div>
</nav>
<?php
if(isset($_GET['blog_id']))
{
	$viewer = new Viewer($conn);
	$blog_id = (int)$_GET['blog_id'];
	$blogs = $viewer->get_all_blogs('',$blog_id);
if($blogs == false)
  {
    echo "<div class = 'container'><div class='alert alert-info text-center'>No blogs published yet!</div></div>";
  }
  else{
    $i=0;
    while($i < count($blogs)) {
    echo '<div class="container">
    <img src ="'.$viewer->get_blog_image($blogs[$i][0]).'" style="width:80%;height:40%;padding-top:2em;"/>
    <div class="page-header">
    <h1>'.$blogs[$i][2].'<br/><small>'.$blogs[$i][4].','.$blogs[$i][6];
    if(!isset($_GET['username']))
    {
    echo '<br/>More by,<a href ="profile.php?username='.$blogs[$i][9].'">'.$blogs[$i][8].'</a></small></h1>';
    }
    //if user try to view his fulll blog then update should be there
    else{
    	echo '<a href = "update.php?blog_id='.$blogs[$i][0].'">,update</a> ';
    }
    if(!is_null($blogs[$i][7]))
    {
      echo '<h3><small>Updated on '.$blogs[$i][7].'</small></h3>';
    }

    echo '</div>
    <h4>'.$blogs[$i][3].'</h4>';
    $i=$i+1;  
    }
    
  }
}
?>