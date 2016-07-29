<?php
// if (!isset($_SESSION['admin']))
// {
// 	header('Location:admin.php');
// }

	include_once 'classes.php';
	include_once 'connection.php';
	$username=$_SESSION['username'];

	$blogger = new Blogger($conn);
	  
	  $permission = $blogger->is_permitted($username);
	  if($permission === "Not Permitted")
	  {
	  	echo '<div class="alert alert-danger" style="width:50%; margin-left:auto; margin-right:auto;"><center>You are not allowed to write blog, ask Admin for permission</center></div>';
	    echo '<a href="userhome.php">Home</a>';
	  }
	  else{
	  		echo '<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container" style="width:50%">
  <form role="form" method="post">
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
    </div>
    <div class="form-group">
      <label for="category">Category</label>
      <input type="text" class="form-control" id="category" name="category" placeholder="Enter Category like sports,music etc" required>
    </div>
    <div class="form-group">
  <label for="desc">Write Here:</label>
  <textarea class="form-control" rows="15" id="desc" required placeholder="Start writing...."></textarea>
</div>
    
    <button type="submit" name="submit" class="btn btn-info">Publish</button>
  </form>
</div>';
}
?>