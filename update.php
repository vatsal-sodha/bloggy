<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Blog</title>
 
      <link href='https://fonts.googleapis.com/css?family=Lora' rel='stylesheet' type='text/css'>
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
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
      <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
</head>
<script type="text/javascript">
  $(document ).ready(function(){
     $(".button-collapse").sideNav();
  })
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
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
       <li><a href="userhome.php" >Home</a></li>
      <li><a href="userhome.php?logout" >Logout</a></li></ul>
      </ul>
    </div>
  </nav>
  </div>
<?php
if(!isset($_GET['blog_id']))
{
	header('Location:userhome.php');
}
if(isset($_GET['blog_id']) && isset($_SESSION['username']))
{
include_once 'classes.php';
include_once 'connection.php';
	$blogger_id= $_GET['blog_id'];
	$blogger = new Blogger($conn);
  $viewer = new Viewer($conn);
	  
	$blog = $blogger->get_blog_update($blogger_id);
	if($blog == true)
	{
    $title = html_entity_decode($blog["blog_title"],ENT_QUOTES);
		echo '<div class="container" style="width:50%;padding-top:2em;">
  <form role="form" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required 
      value="'.$title.'">
    </div>';
    $category = html_entity_decode($blog["blog_category"],ENT_QUOTES);
    echo '<div class="form-group">
      <label for="category">Category</label>
      <input type="text" class="form-control" id="category" name="category" placeholder="Enter Category like sports,music etc" required
       value="'.$category.'">
    </div>';
    echo ' <div class="form-group">
    <img id = "preview" src="'.$viewer->get_blog_image($blogger_id).'" style="width:30%;height:40%;"/>
    <input type="file" name="blog_image" onchange="readURL(this);">
    </div>';

    $desc = html_entity_decode($blog["blog_desc"],ENT_QUOTES);
    echo '<div class="form-group">
  <label for="desc">Write Here:</label>
  <textarea class="form-control" rows="15" id="desc" name="desc" required placeholder="Start writing....">
  '.$desc.'</textarea>
  </div>';
  echo '<button type="submit" name="submit" class="btn btn-info">Publish</button>
  </form>
  </div>';
	}
  if(isset($_POST['submit']))
  {
  $title = htmlspecialchars($_POST['title'],ENT_QUOTES);
  $category = htmlspecialchars($_POST['category'],ENT_QUOTES);
  $desc = htmlspecialchars($_POST['desc'],ENT_QUOTES);
  $blogger_id=$_GET['blog_id'];

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
      chmod($viewer->get_blog_image($blogger_id),0755); //Change the file permissions if allowed
      unlink($viewer->get_blog_image($blogger_id)); //remove the file
      if (move_uploaded_file($_FILES["blog_image"]["tmp_name"], $target_file)) {
          echo "The file ". basename( $_FILES["blog_image"]["name"]). " has been uploaded.";
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }

  $update = $blogger->update($blogger_id,$title,$category,$desc,$target_file);
  if($update == true) 
  {
    
    echo "<script type='text/javascript'>alert('Updated Successfully');window.location.href = 'userhome.php';</script>";
  }
  if($update == false)
  {
    
    echo "<script type='text/javascript'>alert('There is something wrong, try again later');window.location.href = 'userhome.php';</script>";
  }
  }

}
?>
</body></html>