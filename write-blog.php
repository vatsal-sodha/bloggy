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
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="/dist/css/bootstrap.min.css"  media="screen,projection"/>    
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Bloggy</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="userhome.php">Home</a></li></ul>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="write-blog.php" class="glyphicon glyphicon-pencil">Write</a></li>
      <li><a href="userhome.php?logout" class="glyphicon glyphicon-log-out">Logout</a></li> 
        </ul>
        </div></nav>
<div class="container" style="width:50%">
  <form role="form" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required 
      value="<?php if(isset($_SESSION['desc']))echo htmlspecialchars($_SESSION['title'],ENT_QUOTES);?>">
    </div>
    <div class="form-group">
      <label for="category">Category</label>
      <input type="text" class="form-control" id="category" name="category" placeholder="Enter Category like sports,music etc" required
       value="<?php if(isset($_SESSION['desc']))echo htmlspecialchars($_SESSION['category'],ENT_QUOTES);?>">
    </div>
    <!-- <div class="file-field input-field">
    <div class="btn">
    <span>File</span>
    <input type="file">
    </div>
    <div class="file-path-wraaper">
    <input class="file-path validate" type="te">
    </div>
    </div> -->	
    <div class="form-group">
    <input type="file" name="blog_image">
    </div>
    <div class="form-group">
  <label for="desc">Write Here:</label>
  <textarea class="form-control" rows="15" id="desc" name="desc" required placeholder="Start writing...."  
  ><?php if(isset($_SESSION['desc']))echo htmlspecialchars($_SESSION['desc'],ENT_QUOTES);?></textarea>
</div>
    
    <button type="submit" name="submit" class="btn btn-info">Publish</button>
  </form>
</div>
<?php

if(isset($_POST['submit']))
{
	 $title = htmlspecialchars($_POST['title'],ENT_QUOTES);
  	$category = htmlspecialchars($_POST['category'],ENT_QUOTES);
  	$desc = htmlspecialchars($_POST['desc'],ENT_QUOTES);
	$username=$_SESSION['username'];

		$target_dir = "images/";
		$target_file = $target_dir . basename($_FILES["blog_image"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$check = getimagesize($_FILES["blog_image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
	// Check file size
	if ($_FILES["blog_image"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["blog_image"]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES["blog_image"]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}


	$publish = $blogger->publish($username,$title,$category,$desc,$target_file);
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