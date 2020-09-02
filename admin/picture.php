<?php 
require_once 'core/init.php';
if ($user) {
	if (isset($_FILES['img_up'])) {
		foreach ($_FILES['img_up']['name'] as $name => $value) {
			 $dir = "../upload/";
			 $name_img=stripslashes($_FILES['img_up']['name'][$name]);
			 $source_img = $_FILES['img_up']['tmp_name'][$name];
			 $day_current = substr($date_current, 8, 2);
             $month_current = substr($date_current, 5, 2);
             $year_current = substr($date_current, 0, 4);
             if (!is_dir($dir.$year_current)) {
             	mkdir($dir.$year_current.'/');
             }
             if (!is_dir($dir.$year_current.'/'.$month_current)){
                mkdir($dir.$year_current.'/'.$month_current.'/');
            } 
            if (!is_dir($dir.$year_current.'/'.$month_current.'/'.$day_current))
            {
                mkdir($dir.$year_current.'/'.$month_current.'/'.$day_current.'/');
            } 
            $path_img = $dir.$year_current.'/'.$month_current.'/'.$day_current.'/'.$name_img; 
            move_uploaded_file($source_img, $path_img);

            $tmp=explode(".",$name_img);
            $type_img=array_pop($tmp);
            $url_img =substr($path_img, 3);
            $size_img = $_FILES['img_up']['size'][$name];
            $sql_up_file = "INSERT INTO images VALUES (
                '',
                '$url_img',
                '$type_img',
                '$size_img',
                '$date_current'
            )";
            $db->statement($sql_up_file);
		}
		echo 'Upload thành công.';
		new redirect($_DOMAIN.'picture');
	}
	if (isset($_POST['action'])) {
		$action = trim(addslashes(htmlspecialchars($_POST['action'])));
		if ($action=='del-list-img') {
			foreach ($_POST['id_img'] as $key => $value) {
				$sql= "SELECT * from images where id_img='$value'";
				if ($db->numrow($sql)) {
					$data_img = $db->getRow($sql);
					if (file_exists('../'.$data_img['url'])) {
						unlink('../'.$data_img['url']);
					}
					$sql_del= "DELETE from images where id_img='$value'";
					$db->statement($sql_del);
				}
			}
		}else if ($action=='del-img') {
			$id = trim(htmlspecialchars(addslashes($_POST['id'])));
			$sql= "SELECT * from images where id_img='$id'";
			if ($db->numrow($sql)) {
				$data=$db->getRow($sql);
				if (file_exists('../'.$data['url'])) {
					unlink('../'.$data['url']);
				}
				$sql_del= "DELETE from images where id_img='$id'";
				$db->statement($sql_del);
			}
		}
	}
	
}else{
	new redirect($_DOMAIN);
}
 ?>
