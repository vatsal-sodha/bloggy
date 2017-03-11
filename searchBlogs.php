<?php
session_start();
include_once 'classes.php';
include_once 'connection.php';

$viewer = new Viewer($conn);
if(isset($_GET['q']))
{
	$searchedBlogs=array();
$searchedBlogs=$viewer->searchBlogs($_GET['q']);
echo $searchedBlogs;
}
?>