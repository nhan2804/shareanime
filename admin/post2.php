<?php
require_once 'core/init.php';
if ($user) {
 	if (isset($_POST['action'])) {
 		$action = trim(addslashes(htmlspecialchars($_POST['action'])));
 		if ($action == 'load_cate_2') {
        	$parent_id = trim(htmlspecialchars(addslashes($_POST['parent_id'])));
        	$sql_get_cate2= "SELECT label,id_cate from categories WHERE parent_id='$parent_id' and type='2'";
        	if ($db->numrow($sql_get_cate2)) {
        		foreach ($db->getData($sql_get_cate2) as $key => $value) {
        			echo '<option value="' . $value['id_cate'] . '">' . $value['label'] . '</option>';
        		}
        	}else{
        		echo '<option value="0">Không có chuyên mục vừa nào</option>';
        	}
         }else if ($action=='load_cate_3') {
        	$parent_id = trim(htmlspecialchars(addslashes($_POST['parent_id'])));
        	$sql_get_cate3= "SELECT label,id_cate from categories WHERE parent_id='$parent_id' and type='3'";
        	if ($db->numrow($sql_get_cate3)) {
        		foreach ($db->getData($sql_get_cate3) as $key => $value) {
        			echo '<option value="' . $value['id_cate'] . '">' . $value['label'] . '</option>';
        		}
        	}else{
        		echo '<option value="0">Không có chuyên mục vừa nào</option>';
        	}
        }
        }
 	}
 ?>