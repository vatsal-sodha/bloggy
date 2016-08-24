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
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <script src="/materialize/css/materialize.min.css"></script>
</head>
<script type="text/javascript">
	$(document ).ready(function(){
		 $(".button-collapse").sideNav();
	})
	function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result)
                    .width(150)
                    .height(200);;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
<body style="font-family:'Lora',serif;">
<div class="navbar-fixed ">
  <nav>
    <div class="nav-wrapper blue-grey">
      <a href="#!" class="brand-logo" style="text-decoration:none">Bloggy</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
       <li><a href="userhome.php" class =  "btn waves-effect waves-light deep-orange lighten-2">Home</a></li>
      <li><a href="userhome.php?logout" class =  "btn waves-effect waves-light deep-orange lighten-2">Logout</a></li></ul>
      </ul>
      <ul class="side-nav" id="mobile-demo">
       <li><a href="userhome.php">Home</a></li>
      <li><a href="userhome.php?logout">Logout</a></li></ul>
      </ul>
    </div>
  </nav>
  </div>
  

<div class="container" style="width:50%;padding-top:2em;">
<div class="row">
    <form class="col s12" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="input-field col s9">
          <input id="title" type="text" class="validate" name="title" autofocus required  value="<?php if(isset($_SESSION['title']))echo htmlspecialchars($_SESSION['title'],ENT_QUOTES);?>">
          <label for="title">Title</label>
        </div>
        </div>
        <div class="row">
        <div class="input-field col s9">
          <input id="category" type="text" class="validate" name="category" value="<?php if(isset($_SESSION['desc']))echo htmlspecialchars($_SESSION['category'],ENT_QUOTES);?>" required>
          <label for="category">Category</label>
        </div>
        </div>
        <div class="row">
        <img id = "preview" src="#" alt="Your image"/>
       <input type="file" name="blog_image" onchange="readURL(this);">
       </div>
        <div class="row">
        <div class="input-field col s9">
          <textarea id="textarea1" class="materialize-textarea validate" id="desc" name="desc" required=""><?php if(isset($_SESSION['desc']))echo htmlspecialchars($_SESSION['desc'],ENT_QUOTES);?></textarea>
          <label for="textarea1">Start Writing...</label>
        </div>
      </div>
      <button class="btn waves-effect waves-light" type="submit" name="submit">Submit<i class="material-icons right">send</i>
    </button>
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