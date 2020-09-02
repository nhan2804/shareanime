<?php
require_once 'core/init.php';
if ($user) {
 	if (isset($_POST['action'])) {
 		$action = trim(addslashes(htmlspecialchars($_POST['action'])));
 		if ($action='add_post') {
 			$title =trim(addslashes(htmlspecialchars($_POST['title'])));
 			$slug =trim(addslashes(htmlspecialchars($_POST['slug'])));
 			$show_alert = '<script>$("#formaddpost .alert").removeClass("hidden");</script>';
            $hide_alert = '<script>$("#formaddpost .alert").addClass("hidden");</script>';
            $success = '<script>$("#formaddpost .alert").attr("class", "alert alert-success");</script>';
            if ($title=='' || $slug=='') {
            	echo $show_alert.'Vui lòng điền đầy đủ thông tin';
            }else{
            	$sql_check = "SELECT title, slug FROM posts WHERE title = '$title' OR slug = '$slug'";
            	if ($db->numrow($sql_check)) {
            		echo $show_alert."Bài viết hoặc url đã tồn tại, vui lòng chọn tên khác";
            	}else{
            		$sql_add_post = " INSERT INTO posts VALUES ('','$title','','','$slug','','','','','','$datauser[id_acc]','0','0','$date_current') ";
                    $db->statement($sql_add_post);
                    echo $show_alert.$success.'Thêm bài viết thành công.';
                    new redirect($_DOMAIN.'posts');
            	}
            }
 		}
 	}else{
 		new redirect($_DOMAIN.'posts');
 	}
 }
 else{
 		new redirect($_DOMAIN.'posts');
 	}
 ?>