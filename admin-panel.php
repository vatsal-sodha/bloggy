<?php
session_start();
if (!isset($_SESSION['admin']))
{
	header('Location:login.php');
}

include_once 'classes.php';
include_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
    
  <!-- Compiled and minified JavaScript -->
  <!--Import Google Icon Font-->
  <link href = "dist/css/bootstrap.min.css" rel="stylesheet" />
      <link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
       <script type="text/javascript" src="materialize/js/jquery-3.1.0.min.js"></script>
      <script type="text/javascript" src="materialize/js/materialize.min.js"></script>    <script type="text/javascript">
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
      <li><a href="admin-panel.php?logout" class="btn waves-effect waves-light deep-orange lighten-2" style="padding-right:2em;text-decoration:none">Logout</a></li>
      </ul>
       <ul class="side-nav" id="mobile-demo">
         <li><a href="admin-panel.php?logout" style="text-decoration:none">Logout</a></li>
       </ul>
      </div>
      </nav>
      </div>
<?php
$admin = new Admin($conn);
  
  $all_bloggers = $admin->get_bloggers();
  if($all_bloggers === false)
  {
  	echo "<div class='alert alert-info'>No blogger registered</div>";
  }
  else{
  	$i=0;
  	echo ' <div class="container"><table class="table table-striped"><thead><tr>
        <th>Firstname</th>
        <th>Username</th>
        <th>Is_active</th>
        <th></th>
      </tr></thead><tbody>';
  	while($i < count($all_bloggers))
  	{
  		if($all_bloggers[$i][2] == 1)
  		{
  			$all_bloggers[$i][2] = "Active";
  			$flag="deactivate";
  		}
  		else{
  			$all_bloggers[$i][2] = "Not Active";
  			$flag = "activate";
  		}
      echo '<tr>
      		<td>'.$all_bloggers[$i][0].'</td>
      		<td>'.$all_bloggers[$i][1].'</td>
      		<td>'.$all_bloggers[$i][2].'</td>
      		<td><a href="admin-panel.php?flag='.$flag.'&username='.$all_bloggers[$i][1].'">'.$flag.' </a></td>
      		</tr>';
      	$i=$i+1;

  	}
  	echo '</tbody></table></div>';
  }

 if(isset($_GET['flag']) && $_GET['username'])
 {
 	$username=$_GET['username'];
 	$flag=$_GET['flag'];

 	if($flag === "deactivate")
 		$flag=0;
 	else
 		$flag=1;
 	$permission =$admin->permission($username,$flag);
 	if($permission === true)
 	{
 		header('Location:admin-panel.php');
 	}
 	else{
 		 echo '<div class="alert alert-danger" style="width:50%; margin-left:auto; margin-right:auto;"><center>Soory something went wrong</center></div>';
 	}
 }

if(isset($_GET['logout']))
{
  
  $logout =$admin->admin_logout();
  
}
?>