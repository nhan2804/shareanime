<?php 
if (isset($_GET['sp']) && isset($_GET['id']) && isset($_GET['ct'])) {
	require 'lightnovel.php';
}
else if (isset($_GET['n'])) {
	require 'tintuc.php';
}else if (isset($_GET['sc'])) {
	require 'categories.php';
}else if (isset($_GET['search'])) {
	require 'search.php';
}else if (isset($_GET['sp']) && isset($_GET['id'])) {
	require 'posts.php';
}else{
	require 'news.php';
}
 ?>
