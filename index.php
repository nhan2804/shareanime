<?php 
include 'core/init.php';
if ($data_web['status'] ==0) {
    require 'templates/shutdown.php';
    exit;
}
include 'includes/header.php';
if (isset($_GET['in'])) {
	include 'templates/intro.php';
}else{
include 'templates/content.php';
include 'templates/sibar.php';
}
include 'includes/footer.php';
 ?>