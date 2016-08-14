<?php
// if (!isset($_SESSION['admin']))
// {
// 	header('Location:admin.php');
// }

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
</head>

<body>
<nav>
    <div class="nav-wrapper blue-grey">
      <a href="index.php" class="brand-logo" style="text-decoration:none">Bloggy</a>
      <ul id ="nav-mobile" class="right hide-on-med-and-down">
      <li><a href="admin-panel.php?logout" class="btn waves-effect waves-light deep-orange lighten-2" style="padding-right:2em;text-decoration:none">Logout</a></li>
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