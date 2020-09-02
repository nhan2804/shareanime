<?php 
require_once 'classes/database.php';
require_once 'classes/season.php';
require_once 'classes/redirect.php';
$db = new database();
$_DOMAIN = 'http://localhost/shareanime/';
$sql="SELECT * from website ";
if ($db->numrow($sql)) {
	$data_web=$db->getRow($sql);
	$title_web=$data_web['title'];
}
$session = new season();
$session->StartSession();
if ($session->getSs()!='') {
	$user= $session->getSs();
}else{
	$user='';
}
$datauser=null;
if ($user) {
	$getdata="SELECT * from accounts where username='$user'";
	if ($db->numrow($getdata)) {
		$datauser= $db->getRow($getdata);	
	}
}
 ?>