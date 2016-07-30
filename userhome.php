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
  <title>Blog</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
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
      <li class="active"><a href="#">Home</a></li>
      
    </ul>
  <ul class="nav navbar-nav navbar-right">
      <li><a href="write-blog.php" class="glyphicon glyphicon-pencil">Write</a</li>
      <li><a href="userhome.php?logout" class="glyphicon glyphicon-log-out">Logout</a></li> 
        </ul>
      </li>
    </ul>
  </div>
</nav>
<?php

if(isset($_GET['logout']))
{
  
  $blogger->blogger_logout();
}


$blogs = $blogger->get_blog($username);
if($blogs == false)
  {
    echo "<div class = 'container'><div class='alert alert-info text-center'>No blogs published yet!</div></div>";
  }
  else{
    $i=0;
    while($i < count($blogs)) {
    
    echo '<div class="container">
    <div class="page-header">
    <h1>'.$blogs[$i][1].'<br/><small>'.$blogs[$i][3].','.$blogs[$i][4].'</small></h1>
    </div>
    <h4>'.$blogs[$i][2].'</h4>
    </div>';
    $i=$i+1;  
    }
    
  }
?>
</body>
</html>