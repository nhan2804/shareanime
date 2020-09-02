<?php
 
 if ($user) {
 	echo '<h3>Truyện</h3>';
 	if (isset($_GET['ac'])) {
 		$ac = trim(addslashes(htmlspecialchars($_GET['ac'])));
 	}else {
 		$ac = '';
 	}
 	if (isset($_GET['id'])) {
 		$id = trim(addslashes(htmlspecialchars($_GET['id'])));
 	}else{
 		$id = '';
 	}
 	if ($ac!='') {
		if ($ac=='add') {
			echo '
			<a href="'.$_DOMAIN.'lightnovel" class="btn btn-default">
				<i class="glyphicon glyphicon-arrow-left"></i>Trở về
			</a>
			';
			echo '
			<form method="POST" id="formaddln" onsubmit="return false;">
				<div class="form-group">
					<label>Tên truyện</label>
					<input type="text" class="form-control title" name="" id="name_lightnovel">
				</div>
				<div class="form-group">
                	<button type="submit" class="btn btn-primary">Tạo</button>
            	</div>
            	<div class="alert alert-info hidden"></div>
			</form>
			';
		}
		else if ($ac == 'addchapter') {
			echo '
			<a href="' . $_DOMAIN . 'lightnovel" class="btn btn-default">
                <span class="glyphicon glyphicon-arrow-left"></span>Trở về
            </a> 
			<a href="' . $_DOMAIN . 'lightnovel/addchapter/'.$id.'" class="btn btn-default">
                <span class="glyphicon glyphicon-repeat"></span> Reload
            </a> 
            <a class="btn btn-danger" id="del_lightnovel_list">
                <span class="glyphicon glyphicon-trash"></span> Xoá
            </a> 
            </br>
            </br>
			';
			$sql_getChapter="SELECT * FROM lightnovel WHERE id_lightnovel='$id'";
			$data_chapter=$db->getRow($sql_getChapter);
			$name_ln = $data_chapter['name_lightnovel'];
			$sql_get_data= "SELECT * from chapter WHERE Id_lightnovel='$id' ";
			echo '
			<form method="POST" id="formaddchapter" data-id="'.$id.'" onsubmit="return false;">
			<div class="form-group">
	    		<label>Chapter</label>
	    		<input class="form-control" id="name_chapter"  type="text" " name="" required>
	    	</div>
	    	<div class="form-group">
	    		<label>Miêu tả</label>
	    		<input class="form-control" id="dersc_chapter" type="text" " name="">
	    	</div>
	    	<div class="form-group">
	    		<label>Nội dung</label>
	    		<textarea class="form-control" id="body_edit_post"  name=""></textarea>
	    	</div>
	    	<div class="alert-warning alert hidden"></div>
	    	<button class="btn btn-primary" type="submit" >Update</button>
	    	</form>
			';
			echo '<h4>Tên truyện : '.$name_ln.'</h4>';
			echo '
			<div class="table-responsive">
				<table class="table-striped table list">
					<tr>
						<td><input type="checkbox" name=""></td>
						<td>Tập</td>
						<td>Miêu tả</td>
						<td>Tools</td>
					</tr>';
				foreach ($db->getData($sql_get_data) as $key => $value) {
					echo '
					<tr>
						<td><input type="checkbox" value="'.$value['id_chapter'].'" ></td>
						<td>'.$value['name_chapter'].'</td>
						<td>'.$value['desc_chapter'].'</td>
						<td>
							<a class="btn btn-danger" href="'.$_DOMAIN.'lightnovel/'.$value['id_chapter'].'"><span class="glyphicon glyphicon-trash"></span>Xóa
							</a>
							<a class="btn btn-warning" href="'.$_DOMAIN.'lightnovel/'.$value['id_chapter'].'"><span class="glyphicon glyphicon-edit"></span>Sửa
							</a>
						</td>
					</tr>
					';
				}
				echo "</table>
				</div>";
		}else if ($ac == 'edit') {
			$sql_check = "SELECT id_lightnovel, author_id FROM lightnovel WHERE id_lightnovel= '$id'";
			// echo $sql_check;
			if ($db->numrow($sql_check)) {
				$data_post = $db->getRow($sql_check);
				if ($data_post['author_id'] == $datauser['id_acc'] || $datauser['position'] == '0') {
					echo
                    '
                        <a href="' . $_DOMAIN . 'lightnovel" class="btn btn-default">
                            <span class="glyphicon glyphicon-arrow-left"></span> Trở về
                        </a>
                        <a class="btn btn-danger" id="del_ln" data-id="' . $id . '">
                            <span class="glyphicon glyphicon-trash"></span> Xoá
                        </a> 
                    ';
                    $sql_get_data_lightnovel = "SELECT * FROM lightnovel WHERE id_lightnovel = '$id'";
                    if ($db->numrow($sql_get_data_lightnovel)) {
                      	$data_edit = $db->getRow($sql_get_data_lightnovel);
                      	echo '
                      	<br>
                      	<br>
			        	<form method="POST" onsubmit="return false;" id="formeditln" data-id="'.$id.'">
			        	<div class="form-group">
			        		<label>Tên truyện</label>
			        		<input class="form-control title" id="name_ln_edit" type="text" value="'.$data_edit['name_lightnovel'].'" name="">
			        	</div>
			        	<div class="form-group">
			        		<label>URl hình ảnh</label>
			        		<input type="text" id="url_ln_edit" class="form-control " value="'.$data_edit['img_lightnovel'].'" name="">
			        	</div>
			        	<div class="form-group">
			        		<label>Giới thiệu Truyện</label>
			        		<textarea id="desrc_ln_edit" class="form-control">'.$data_edit['descr_lightnovel'].'</textarea>
			        	</div>

			        	<div class="form-group">
		        		<label>Thể loại</label>
		        		<div class="form-control" id="category_lightnovel">';
		        		$sql_get_kind= "SELECT * from kind";
		        		$cate = $data_edit['category_lightnovel'];
		        		$kind = explode(" ", $cate);
		        		foreach ($db->getData($sql_get_kind) as $key => $value) {
		        			$check=false;
		        			for ($i=0; $i <count($kind) ; $i++) {
		        				if ($value['id_kind']==$kind[$i]) {
		        					$check=true;
		        					break;
		        				}else{
		        					$check=false;
		        				}
		        			}
		        			if ($check) {
		        				echo '
				        			<label>
				        			<input type ="checkbox" checked name="kind" value="'.$value['id_kind'].'"/> '.$value['name_kind'].'
				        			</label>';
		        			}else{
		        				echo '
				        			<label>
				        			<input type ="checkbox"  name="kind" value="'.$value['id_kind'].'"/> '.$value['name_kind'].'
				        			</label>';
		        			}
		        		}
		        		echo '
		        		</div>
			        		<div class="form-group">
			        			<label>Chọn Năm</label>
			        		<select class="form-control" id="cate_edit-2">';
			        	$sql_get_cate_post_2 = "SELECT label, id_cate FROM categories WHERE type = '2' and id_cate!= '58'";
			        	if ($db->numrow($sql_get_cate_post_2)) {
			        		if ($data_edit['cate_2_id']==0) {
			        			echo '<option value="">Vui lòng chọn chuyên mục</option>';
			        		}
			        		foreach ($db->getData($sql_get_cate_post_2) as $key => $value) {
			        			if ($value['id_cate']==$data_edit['cate_2_id']) {
			        				echo '<option value="'.$value['id_cate'].'" selected>'.$value['label'].'</option>';
			        			}else{
			        				echo '<option value="'.$value['id_cate'].'" >'.$value['label'].'</option>';
			        			}
			        		}
			        	}else{
			        		echo '<option value="">Chưa có chuyên mục vừa nào!</option>';
			        	}
			        	echo '</select>
			        	</div>
			        		<div class="form-group">
			        			<label>Chọn mùa</label>
			        		<select class="form-control" id="cate_edit-3">';
			        	$sql_get_cate_post_3 = "SELECT label, id_cate FROM categories WHERE type = '3'";
			        	if ($db->numrow($sql_get_cate_post_3)) {
			        		if ($data_edit['cate_3_id']==0) {
			        			echo '<option value="">Vui lòng chọn chuyên mục</option>';
			        		}
			        		foreach ($db->getData($sql_get_cate_post_3) as $key => $value) {
			        			if ($value['id_cate']==$data_edit['cate_id_3']) {
			        				echo '<option value="'.$value['id_cate'].'" selected>'.$value['label'].'</option>';
			        			}else{
			        				echo '<option value="'.$value['id_cate'].'" >'.$value['label'].'</option>';
			        			}
			        		}
			        	}else{
			        		echo '<option value="">Chưa có chuyên mục con nào!</option>';
			        	}
			        	echo '</select>
			        	
			        	</div';
		        		echo
		        		'
		        		</div>
		        		<br>
		        		<div class="form-group">
		        			<button type="submit" class="btn btn-primary">Lưu thay đổi</button>
		        		</div>
		        		<div class="alert alert-danger hidden"></div>
		        		</form>
		        		';
                      }  
				}else{
					echo '<div class="alert alert-danger">Bài viết không thuộc quyền sở hữu của bạn.</div>';
				}

			}else{
				echo '<div class="alert alert-danger">Bài viết không tồn tại !</div>';
			}
		}
 		}else{
 			echo '
			<a href="' . $_DOMAIN . 'lightnovel/add" class="btn btn-success">
                <span class="glyphicon glyphicon-plus"></span> Thêm
            </a> 
            <a href="' . $_DOMAIN . 'lightnovel" class="btn btn-default">
                <span class="glyphicon glyphicon-repeat"></span> Reload
            </a> 
            <a class="btn btn-danger" id="del_lightnovel_list">
                <span class="glyphicon glyphicon-trash"></span> Xoá
            </a> 
            <br>
            <br>
            ';
 			$sql_get_ln="SELECT * from lightnovel Order by id_lightnovel Desc";
 			if ($db->numrow($sql_get_ln)) {
 			echo '
			<div class="table-responsive">
				<table class="table-striped table list" >
					<tr>
						<td><input type="checkbox" name=""></td>
						<td>Tên Truyện</td>
						<td>Thể loại</td>
						<td>Số Chapter</td>
						<td>Ngày tạo</td>
						<td>Tool</td>
					</tr>';
						foreach ($db->getData($sql_get_ln) as $key => $value) {
							$sql_get_numchapter= "SELECT COUNT(Num_Chapter) as num_chapter from chapter WHERE Id_lightnovel='$value[id_lightnovel]'";
							$data_tmp = $db->getRow($sql_get_numchapter);
							$num_chapter = $data_tmp['num_chapter'];
							echo '
								<tr>
									<td><input value="'.$value['id_lightnovel'].'" type="checkbox" name="">
									</td>

									<td><a href="'.$_DOMAIN.'lightnovel/edit/'.$value['id_lightnovel'].'">'.$value['name_lightnovel'].'</a>
									</td>
									<td>'.$value['category_lightnovel'].'</td>
									<td>'.$num_chapter.'/?</td>
									<td>'.$value['data_updated'].'</td>
									<td>
										<a class="btn btn-success" href="'.$_DOMAIN.'lightnovel/addchapter/'.$value['id_lightnovel'].'"><span class="glyphicon glyphicon-plus"></span>Thêm Chapter</a>
										<a class="btn btn-danger" href="'.$_DOMAIN.'lightnovel/'.$value['id_lightnovel'].'"><span class="glyphicon glyphicon-trash"></span>Xóa</a>
										<a class="btn btn-warning" href="'.$_DOMAIN.'lightnovel/'.$value['id_lightnovel'].'"><span class="glyphicon glyphicon-edit"></span>Sửa</a>
									</td>
								</tr>
							';
						}
						echo '
						</table>
					</div>
						';
					}
				else{
					echo '<div class="alert alert-warning">Hiện không có truyện nào</div>';
				}
		}
 }else{
 	new redirect($_DOMAIN);
 }
 ?>