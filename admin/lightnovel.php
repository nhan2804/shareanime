<?php
require_once 'core/init.php';
if (isset($user)) {
 	if (isset($_POST['action'])) {
 		$action = trim(addslashes(htmlspecialchars($_POST['action'])));
 		if ($action=='add_lightnovel') {
 			$name_ln= trim(addslashes(htmlspecialchars($_POST['name_ln'])));
 			$url_ln= trim(addslashes(htmlspecialchars($_POST['url_ln'])));
 			$namechapter= trim(addslashes(htmlspecialchars($_POST['namechapter'])));
 			$sql_check= "SELECT * from lightnovel where url_lightnovel ='$url_ln'";
 			if ($db->numrow($sql_check)) {
 				echo "Truyện này đã tồn tại, vui lòng chọn 1 tên khác!";
 			}else{
 				// $sql =" INSERT into lightnovel VALUES ('','$name_ln','','','$url_ln','','','$date_current',46,'','','$datauser[id_acc]','')";
 				$sql =" INSERT into lightnovel VALUES ('','$name_ln','','$date_current','','','','$datauser[id_acc]','','$date_current','','$url_ln','0')";
 				try {
 					$db->statement($sql);
 					echo $sql;
 				} catch (Exception $e) {
 					echo $e;
 				}
 				
 				echo "Thêm thành công";
 			}
 		}else if ($action=='add_chapter') {
 			$namechapter= trim(addslashes(htmlspecialchars($_POST['namechapter'])));
 			$derscchapter= trim(addslashes(htmlspecialchars($_POST['derscchapter'])));
 			$content= trim(addslashes(htmlspecialchars($_POST['content'])));
 			$idln=trim(addslashes(htmlspecialchars($_POST['idln'])));
 			$sql_get_num_chap = "SELECT COUNT(num_chapter) as num from chapter where id_lightnovel='$idln' ";
 			$data_chapter = $db->getRow($sql_get_num_chap);
 			$next_chapter=$data_chapter['num'];
 			if ($next_chapter==0) {
 				$next_chapter=1;
 			}else{
 				$next_chapter++;
 			}
 			$sql = "INSERT into chapter VALUES('','$namechapter','$derscchapter','$next_chapter','$idln','$content','$date_current','','0')";
 			echo $sql;
 			$db->statement($sql);
 			// echo "Update thành công";
 		}else if ($action=='edit_ln') {
 			$nameln =trim(addslashes(htmlspecialchars($_POST['nameln'])));
			$urlln = trim(addslashes(htmlspecialchars($_POST['urlln'])));
			$desrcln = trim(addslashes(htmlspecialchars($_POST['desrcln'])));
			$cate_edit_1 = 1;
			$cate_edit_2 = trim(addslashes(htmlspecialchars($_POST['cate_edit_2'])));
			$cate_edit_3 = trim(addslashes(htmlspecialchars($_POST['cate_edit_3'])));
			$id_ln =trim(addslashes(htmlspecialchars($_POST['id_ln'])));
			$cate='';
			foreach ($_POST['kind'] as $key => $value ) {
				$cate.=$value.' ';
			}
			$sql_edit_ln = "UPDATE lightnovel SET name_lightnovel='$nameln',descr_lightnovel='$desrcln',img_lightnovel='$urlln',cate_1_id='$cate_edit_1',cate_2_id='$cate_edit_2',cate_id_3='$cate_edit_3',data_updated='$date_current',category_lightnovel = '$cate' where id_lightnovel='$id_ln'";
			// echo $sql_edit_ln;
			$db->statement($sql_edit_ln);
 		}
 	}else{
 		new redirect($_DOMAIN);
 	}
 }else{
 		new redirect($_DOMAIN);
 	} 
 ?>