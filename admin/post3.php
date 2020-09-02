<?php 
require_once 'core/init.php';
if ($user) {
	if (isset($_POST['action'])) {
		$action =trim(addslashes(htmlspecialchars($_POST['action'])));
			if ($action=='edit_post') {
        	$id_edit_post = trim(addslashes(htmlspecialchars($_POST['id_edit_post'])));
			$status_edit= trim(addslashes(htmlspecialchars($_POST['status_edit'])));
			$title_edit= trim(addslashes(htmlspecialchars($_POST['title_edit'])));
			$slug_edit= trim(addslashes(htmlspecialchars($_POST['slug_edit'])));
			$url_edit= trim(addslashes(htmlspecialchars($_POST['url_edit'])));
			$dercs_edit= trim(addslashes(htmlspecialchars($_POST['dercs_edit'])));
			$kw_edit= trim(addslashes(htmlspecialchars($_POST['kw_edit'])));
			// $cate_1_edit=0 trim(addslashes(htmlspecialchars($_POST['cate_1_edit'])));
			// $cate_2_edit=0 trim(addslashes(htmlspecialchars($_POST['cate_2_edit'])));
			// $cate_3_edit=0 trim(addslashes(htmlspecialchars($_POST['cate_3_edit'])));
			$cate_1_edit=0;
			$cate_2_edit=0;
			$cate_3_edit=0;
			$body_edit= trim(addslashes(htmlspecialchars($_POST['body_edit'])));
			$show_alert = '<script>$("#formeditpost .alert").removeClass("hidden");</script>';
		    $hide_alert = '<script>$("#formeditpost .alert").addClass("hidden");</script>';
		    $success = '<script>$("#formeditpost .alert").attr("class", "alert alert-success");</script>';
		    $sql_check_id_post = "SELECT id_post FROM posts WHERE id_post = '$id_edit_post'";
		    if (!$db->numrow($sql_check_id_post)) {
		    	echo $show_alert.'Có lỗi xảy ra, vui lòng thử lại sau 1.';
		    }else{
	        	$sql_edit_post = "UPDATE posts SET
	            status = '$status_edit',
	            title = '$title_edit',
	            slug = '$slug_edit',
	            url_thumb = '$url_edit',
	            descr = '$dercs_edit',
	            keywords = '$kw_edit',
	            cate_1_id = '$cate_1_edit',
	            cate_2_id = '$cate_2_edit',
	            cate_3_id = '$cate_3_edit',
	            body = '$body_edit'
	            WHERE id_post = '$id_edit_post';
	        ";
	        $db->statement($sql_edit_post);
	        echo $show_alert.$success.'Chỉnh sửa bài viết thành công.';
        	new redirect($_DOMAIN.'posts');
        	}
		}
		if ($action=='del_list_post') {
			foreach ($_POST['id_post'] as $key => $value) {
			$sql_check_post= "SELECT id_post from posts WHERE id_post='$value'";
			if ($db->numrow($sql_check_post)) {
				$sql_del_post= "DELETE from posts WHERE id_post='$value'";
				$db->statement($sql_del_post);
			}
		}
		new redirect($_DOMAIN.'posts');
	}
	if ($action=='del_post') {
		$id_edit = trim(addslashes(htmlspecialchars($_POST['id_edit'])));
		$sql_del_id_post = "SELECT id_post from posts WHERE id_post='$id_edit'";
		if ($db->numrow($sql_del_id_post)) {
			$db->statement("DELETE from posts WHERE id_post='$id_edit'");
		}
		new redirect($_DOMAIN.'posts');
	}
}
}
 ?>