<?php
session_start();
// if (!isset($_SESSION['admin']))
// {
// 	header('Location:admin.php');
// }

	include_once 'classes.php';
	include_once 'connection.php';
	$username=$_SESSION['username'];

	$blogger = new Blogger($conn);
	  
	  $permission = $blogger->is_permitted($username);
	  if($permission == false)
	  {
	  	echo "<script type='text/javascript'>alert('You are not Permitted to write blog contact admin');window.location.href = 'userhome.php';</script>";
	  }
	  

?>
<html lang="en">
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
      <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required 
      value="<?php echo htmlentities($_SESSION['title']);?>">
    </div>
    <div class="form-group">
      <label for="category">Category</label>
      <input type="text" class="form-control" id="category" name="category" placeholder="Enter Category like sports,music etc" required
       value="<?php echo htmlentities($_SESSION['category']);?>">
    </div>
    <div class="form-group">
  <label for="desc">Write Here:</label>
  <textarea class="form-control" rows="15" id="desc" name="desc" required placeholder="Start writing...."  
  ><?php echo htmlentities($_SESSION['desc']);?></textarea>
</div>
    
    <button type="submit" name="submit" class="btn btn-info">Publish</button>
  </form>
</div>
<?php

if(isset($_POST['submit']))
{
	$title = $_POST['title'];
	$category = $_POST['category'];
	$desc = htmlspecialchars($_POST['desc']);
	$username=$_SESSION['username'];


	$publish = $blogger->publish($username,$title,$category,$desc);
	if($publish == true)
	{
		unset($_SESSION['title']);
		unset($_SESSION['category']);
		unset($_SESSION['desc']);
		echo "<script type='text/javascript'>alert('Published Succesfully');window.location.href = 'userhome.php';</script>";
	}
	if($publish == false){
		$_SESSION['title'] = $title;
		$_SESSION['category'] = $category;
		$_SESSION['desc'] = $desc;
		echo "<script type='text/javascript'>alert('There is something wrong, your blog is saved as draft');window.location.href = 'userhome.php';</script>";
	}
	if($publish == "No blogger id found"){
		echo "No id found";
	}

}
?>