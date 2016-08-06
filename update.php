<?php
session_start();
?>
<!DOCTYPE html>
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
	  
	$blog = $blogger->get_blog_update($blogger_id);
	if($blog == true)
	{
    $title = html_entity_decode($blog["blog_title"],ENT_QUOTES);
		echo '<div class="container" style="width:50%">
  <form role="form" method="post">
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


  $update = $blogger->update($blogger_id,$title,$category,$desc);
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