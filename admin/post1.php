<?php 
require_once 'core/init.php';
if ($user) {
 	if (isset($_POST['action'])) {
 		$action = trim(addslashes(htmlspecialchars($_POST['action'])));
 		if ($action=='search'){
 			$search_post= trim(addslashes(htmlspecialchars($_POST['search'])));
                  if ($search_post=='') {
                       $sql_search_post="SELECT * FROM posts ORDER BY id_post DESC";
                  }else{
 			$sql_search_post = "SELECT * FROM posts WHERE 
                  id_post LIKE '%$search_post%' OR
                  title LIKE '%$search_post%' OR
                  slug LIKE '%$search_post%'
                  ORDER BY id_post DESC ";
                  }
            if ($db->numrow($sql_search_post)) {
            	echo '
            	<div class="table-responsive" id="list_post">
            		<table class="table table-striped list">
            			<tr>
		            		<td><input type="checkbox"></td>
		                    <td><strong>ID</strong></td>
		                    <td><strong>Tiêu đề</strong></td>
		                    <td><strong>Trạng thái</strong></td>
		                    <td><strong>Chuyên mục</strong></td>
		                    <td><strong>Lượt xem</strong></td>
            		
            	';
            	if ($datauser['position']==0) {
            		echo "<td><strong>Tác giả</strong></td>";
            	}
            	echo "
            		<td><strong>Tools</strong></td>
            	</tr>";
            	foreach ($db->getData($sql_search_post) as $key => $value) {
            		if ($value['status']==0) {
            			$status_post = '<label class="label label-warning">Ẩn</label>';
            		}else{
            			$status_post = '<label class="label label-warning">Cho phép</label>';
            		}
            		$cate_post='';
            		$sql_check1= "SELECT label,id_cate FROM categories WHERE id='$value[cate_1_id]' and type='1'";
            		if ($db->numrow($sql_check1)) {
            			$data_tmp1 =$db->getRow($sql_check1);
            			$cate_post.=$data_tmp1['label'];
            		}else{
            			$cate_post.='<span class="text-danger">Lỗi<span>';
            		}
            		$sql_check2= "SELECT label,id_cate FROM categories WHERE id='$value[cate_2_id]' and type='2'";
            		if ($db->numrow($sql_check2)) {
            			$data_tmp2 =$db->getRow($sql_check2);
            			$cate_post.=$data_tmp2['label'];
            		}else{
            			$cate_post.='<span class="text-danger">Lỗi<span>';
            		}
            		$sql_check3= "SELECT label,id_cate FROM categories WHERE id='$value[cate_3_id]' and type='3'";
            		if ($db->numrow($sql_check3)) {
            			$data_tmp3 =$db->getRow($sql_check3);
            			$cate_post.=$data_tmp3['label'];
            		}else{
            			$cate_post.='<span class="text-danger">Lỗi<span>';
            		}
            		$sql_get_author= "SELECT display_name from accounts WHERE id_acc='$value[author_id]'";
            		if ($db->numrow($sql_get_author)) {
            			$data_tmp4= $db->getRow($sql_get_author);
            			$name_author=$data_tmp4['display_name'];
            		}else{
            			$name_author='<span class="text-danger">Lỗi</span>';
            		}
            		echo '
            		<tr>
            			<td><input type="checkbox" name="id_post[]" value="'.$value['id_post'] .'"></td>
            			<td>'.$value['id_post'].'</td>
            			<td style="width: 30%;"><a href="'.$_DOMAIN.'posts/edit/'.$value['id_post'].'">'.$value['title'].'</a></td>
            			<td>'.$status_post.'</td>
            			<td>'.$cate_post.'</td>
            			<td>'.$value['view'].'</td>
            		';
            		if ($datauser['position']==0) {
            			echo '<td>'.$name_author.'</td>';
            		}
            		echo '
			                <td>
			                    <a href="' . $_DOMAIN . 'posts/edit/' . $value['id_post'] .'" class="btn btn-primary btn-sm">
			                        <span class="glyphicon glyphicon-edit"></span>
			                    </a>
			                    <a class="btn btn-danger btn-sm del-post-list" data-id="' . $value['id_post'] . '">
			                        <span class="glyphicon glyphicon-trash"></span>
			                    </a>
			                </td>
			            </tr>
			        ';
            	}
            	echo
			    '
			            </table>
			    ';
            }else{

            	echo '<br>
            	<div class="alert alert-info">Không tìm thấy kết quả nào</div>';
            }
 		}
 	}else{
 		new redirect("k");
 	}
 }else{
 		new redirect("k");
 	}
 ?>