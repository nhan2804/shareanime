<?php 
include_once 'core/init.php';
if ($user) {
	if (isset($_POST['action'])) {
		$action = trim(addslashes(htmlspecialchars($_POST['action'])));
		if ($action=='edit_stt') {
			$status = trim(addslashes(htmlspecialchars($_POST['status'])));
			$sql_edit_stt = "UPDATE website SET status='$status'";
			$db->statement($sql_edit_stt);
		}else if($action=='edit_info'){
		$title = trim(addslashes(htmlspecialchars($_POST['title'])));
		$desrc = trim(addslashes(htmlspecialchars($_POST['desrc'])));
		$kw = trim(addslashes(htmlspecialchars($_POST['kw'])));
		$sql_info_web = "UPDATE website SET 
        title = '$title',
        descr = '$desrc',
        keywords = '$kw'
    	";
    	$db->statement($sql_info_web);
	}else{
		new redirect($_DOMAIN);
	}
}else{
		new redirect($_DOMAIN);
	}
}else{
		new redirect($_DOMAIN);
	}
 ?>