<?php 
require_once 'classes/database.php';
require_once 'classes/season.php';
require_once 'classes/redirect.php';
$db = new database();
$_DOMAIN = 'http://localhost/shareanime/admin/';
date_default_timezone_set('Asia/Ho_Chi_Minh'); 
$date_current = '';
$date_current = date("Y-m-d H:i:sa");
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
