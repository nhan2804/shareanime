<?php 
if ($user) {
	if ($datauser['position']==1) {
		echo '<div class="alert alert-danger">Bạn không có đủ quyền để vào trang này.</div>';
	}else{
		echo '<h3>Chuyên mục</h3>';
		if (isset($_GET['ac'])) {
			$ac = trim(addslashes(htmlspecialchars($_GET['ac'])));
		}else{
			$ac ='';
		}
		if (isset($_GET['id'])) {
			$id = trim(addslashes(htmlspecialchars($_GET['id'])));
		}else{
			$id ='';
		}
		if ($ac!='') {

			if ($ac=='add') {
				 echo
                '
                    <a href="' . $_DOMAIN . 'categories" class="btn btn-default">
                        <span class="glyphicon glyphicon-arrow-left"></span> Trở về
                    </a> 
                ';
                echo '
                <form action="POST" id="formaddcate" onsubmit="return false">
                	<div class="form-group">
                		<label class="lable_add">Tên chuyên mục</label>
                		<input type="text" class="form-control title" id="title" placeholder="Nhập tên chuyên mục." name="">
                	</div>
                	<div class="form-group">
                		<label>URL chuyên mục</label>
                		<input type="text" class="form-control slug" id="slug" placeholder="Nhấp vào để tạo url" name="">
                	</div>
                	<div class="form-group">
                		<label>Loại chuyên mục</label>
                		<div class="radio">
                			<label>
                				<input class="type_cate_1" type="radio" name="add_type_cate" checked value="1">Lớn
                			</label>
                		</div>
                		<div class="radio">
                			<label>
                				<input class="type_cate_2" type="radio" name="add_type_cate" value="2">Vừa
                			</label>
                		</div>
                		<div class="radio">
                			<label>
                				<input class="type_cate_3" type="radio" name="add_type_cate" value="3">Nhỏ
                			</label>
                		</div>
                	</div>
                	<div class="form-group hidden parent_add_cate">
                		<label>Parent chuyên mục</label>
                		<select id="parent_add_cate" class="form-control"></select>
                	</div>
                	<div class="form-group">
                		<label>Sort</label>
                		<input type="text" id="sort_add_type" class="form-control" name="">
                	</div>
                	<button type="submit" id="create_cate" class="bnt btn-primary btn-outline-info">Tạo</button>
                	<div id="error_create" class="alert alert-danger hidden"></div>
                </form>';
			}else if ($ac=='edit') {
				$check_id = "SELECT id_cate from categories where id_cate='$id'";
				if ($db->numrow($check_id)) {
					echo
                    '
                        <a href="' . $_DOMAIN . 'categories" class="btn btn-default">
                            <span class="glyphicon glyphicon-arrow-left"></span> Trở về
                        </a>
                        <a class="btn btn-danger" id="del_cate" data-id="' . $id . '">
                            <span class="glyphicon glyphicon-trash"></span> Xoá
                        </a> 
                    ';
                    $sql_get_data = "SELECT * FROM categories WHERE id_cate = '$id'";
                    $data_edit;
                    $parent_edit;
                    if ($db->numrow($sql_get_data)) {
                        $data_edit = $db->getRow($sql_get_data);
                        $check_type1='';
                        $check_type2='';
                        $check_type3='';
                        if ($data_edit['type']=='1') {
                            $check_type1='checked';
                            $parent_edit='
                            <div class="form-group hidden parent_edit_cate">
                                <label>Parent chuyên mục</label>
                                <select id="parent_edit_cate" class="form-control"></select>
                            </div>
                            ';
                        }else if ($data_edit['type']=='2') {       
                            $check_type2='checked';
                            $parent_edit='
                            <div class="form-group parent_edit_cate">
                                <label>Parent chuyên mục</label>
                                <select id="parent_edit_cate" class="form-control">
                            ';
                            $sql_edit="SELECT * from categories where type='1'";
                            if ($db->numrow($sql_edit)) {
                                foreach ($db->getData($sql_edit) as $key => $value) {
                                    if ($data_edit['parent_id']==$value['id_cate']) {
                                        $parent_edit .='<option value="'.$value['id_cate']. '" selected>'.$value['label'].'</option>';  
                                    }else{
                                        $parent_edit .='<option value="'.$value['id_cate']. '" >'.$value['label'].'</option>';
                                    }
                                }
                            }else{
                                $parent_edit .='<option value="0">Hiện chưa có chuyên mục cha nào</option>';
                            }
                             $parent_edit .= '</select>
                                            </div> ';
                        }else if ($data_edit['type']=='3') {
                            $check_type3='checked';
                            $parent_edit='
                            <div class="form-group parent_edit_cate">
                                <label>Parent chuyên mục</label>
                                <select id="parent_edit_cate" class="form-control">
                            ';
                            $sql_edit="SELECT * from categories where type='2'";
                            if ($db->numrow($sql_edit)) {
                                foreach ($db->getData($sql_edit) as $key => $value) {
                                    if ($data_edit['parent_id']==$value['id_cate']) {
                                        $parent_edit .='<option value="'.$value['id_cate'].'" selected>'.$value['label'].'</option>';
                                    }else{
                                        $parent_edit .='<option value="'.$value['id_cate'].'">'.$value['label'].'</option>';
                                    }
                                }
                            }else{
                                $parent_edit .='<option value="0">Hiện chưa có chuyên mục cha nào</option>';
                            }
                            $parent_edit .='</select>
                                            </div> ';
                        }
                        echo '
                <form action="POST" id="formeditcate" data-id="'.$id.'" onsubmit="return false">
                    <div class="form-group">
                        <label class="lable_add">Tên chuyên mục</label>
                        <input type="text" class="form-control title" id="title" value="'.$data_edit['label'].'" placeholder="Nhập tên chuyên mục cần sửa." name="">
                    </div>
                    <div class="form-group">
                        <label>URL chuyên mục</label>
                        <input type="text" class="form-control slug" id="slug" value="'.$data_edit['url'].'" placeholder="Nhấp vào để tạo url" name="">
                    </div>
                    <div class="form-group">
                        <label>Loại chuyên mục</label>
                        <div class="radio">
                            <label>
                                <input class="type_cate_1" type="radio" name="edit_type_cate" '.$check_type1.' value="1">Lớn
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input class="type_cate_2" type="radio" name="edit_type_cate" '.$check_type2.' value="2">Vừa
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input class="type_cate_3" type="radio" name="edit_type_cate" '.$check_type3.' value="3">Nhỏ
                            </label>
                        </div>
                    </div>
                    '.$parent_edit.'
                    <div class="form-group">
                        <label>Sort</label>
                        <input type="text" id="sort_edit_type" value="'.$data_edit['sort'].'" class="form-control" name="">
                    </div>
                    <button type="submit" id="edit_cate" class="bnt btn-primary btn-outline-info">Lưu thay đổi</button>
                    <div id="error_edit" class="alert alert-danger hidden"></div>
                </form>';
                    }
				}else {
					 echo
                    '
                        <div class="alert alert-danger">ID chuyên mục đã bị xoá hoặc không tồn tại.</div>
                    ';
				}
			}
		}else{
			echo
            '
                <a href="' . $_DOMAIN . 'categories/add" class="btn btn-success">
                    <span class="glyphicon glyphicon-plus"></span> Thêm
                </a> 
                <a href="' . $_DOMAIN . 'categories" class="btn btn-default">
                    <span class="glyphicon glyphicon-repeat"></span> Reload
                </a> 
                <a class="btn btn-danger" id="del_cate_list">
                    <span class="glyphicon glyphicon-trash"></span> Xoá
                </a> 
            ';
            $get_datas = "SELECT * FROM categories ORDER BY id_cate DESC";
            if ($db->numrow($get_datas)) {
                echo '
                <br/>
                <br/>
                <div class="table-responsive">
                    <table class="table table-striped list" id="list">
                        <tr>
                            <td><input type="checkbox" name=""></td>
                            <td>ID</td>
                            <td>Tên chuyên mục</td>
                            <td>Loại</td>
                            <td>Chuyên mục cha</td>
                            <td>Sort</td>
                            <td>Tools</td>
                        </tr>';
                foreach ($db->getData($get_datas) as $key => $value) {
                   $sql_get_parent = "SELECT * from categories where id_cate='$value[parent_id]'";
                   if ($db->numrow($sql_get_parent)) {
                       $get_parent = $db->getRow($sql_get_parent);
                       if ($get_parent['type']==1 && $value['type']==3) {
                           $lable_parent = '<p class="text-danger">Lỗi</p>';
                       }elseif ($get_parent['type']==3 && $value['type']==2) {
                           $lable_parent = '<p class="text-danger">Lỗi</p>';
                       }elseif ($get_parent['type']==3 && $value['type']==1) {
                           $lable_parent = '<p class="text-danger">Lỗi</p>';
                       }elseif ($get_parent['type']==$value['type']) {
                           $lable_parent = '<p class="text-danger">Lỗi</p>';
                       }else{
                        $lable_parent=$get_parent['label'];
                       }
                   }else{
                     $lable_parent='';
                   }
                   if ($value['type']==1) {
                       $value['type']='Lớn';
                   }elseif ($value['type']==2) {
                       $value['type']='Vừa';
                   }elseif ($value['type']==3) {
                       $value['type']='Nhỏ';
                   }
                   echo '
                   <tr>
                       <td><input type="checkbox" name="id_cate[]" value="'.$value['id_cate'].'"></td>
                       <td>'.$value['id_cate'].'</td>
                       <td><a href="'.$_DOMAIN.'categories/edit/'.$value['id_cate'].'">'.$value['label'].'</a></td>
                       <td>'.$value['type'].'</td>
                       <td>'.$lable_parent.'</td>
                       <td>'.$value['sort'].'</td>
                       <td>
                            <a href="' . $_DOMAIN . 'categories/edit/' . $value['id_cate'] .'" class="btn btn-primary btn-sm">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                            <a id="del_cate" class="btn btn-danger btn-sm del-cate-list" data-id="' . $value['id_cate'] . '">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
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
                echo '<br><br><div class="alert alert-info">Chưa có chuyên mục nào.</div>';
            }
		}
	}
}else{
	new redirect($_DOMAIN);
}
 ?>