<?php 
if ($user) {
	if ($datauser['position']==1) {
		echo '<div class="alert alert-danger">Bạn không có quyền vào trang này</div>';
	}else{
	echo "<h3>Tài khoản</h3>";
		if (isset($_GET['ac'])){
            $ac = trim(addslashes(htmlspecialchars($_GET['ac'])));
        }
        else{
            $ac = '';
        }
        if (isset($_GET['id'])){
            $id = trim(addslashes(htmlspecialchars($_GET['id'])));
        }
        else{
            $id = '';
        }
        if ($ac!='') {
        	if ($ac=='add') {
        		echo
                '
                    <a href="' . $_DOMAIN . 'accounts" class="btn btn-default">
                        <span class="glyphicon glyphicon-arrow-left"></span> Trở về
                    </a> 
                ';
                echo '
                <form method="POST" id="formAddAcc" onsubmit="return false;">
		            <div class="form-group">
		                <label>Tên đăng nhập</label>
		                <input type="text" class="form-control title" id="un_add_acc">
		            </div>
		            <div class="form-group">
		                <label>Mật khẩu</label>
		                <input type="password" class="form-control title" id="pw_add_acc">
		            </div>
		            <div class="form-group">
		                <label>Nhập lại mật khẩu</label>
		                <input type="password" class="form-control title" id="repw_add_acc">
		            </div>
		            <div class="form-group">
		                <button type="submit" class="btn btn-primary">Thêm</button>
		            </div>
		            <div class="alert alert-danger hidden"></div>
		        </form>
                ';
        	}
        }else{
        	echo
            '
                <a href="' . $_DOMAIN . 'accounts/add" class="btn btn-success">
                    <span class="glyphicon glyphicon-plus"></span> Thêm
                </a> 
                <a href="' . $_DOMAIN . 'accounts" class="btn btn-default">
                    <span class="glyphicon glyphicon-repeat"></span> Reload
                </a>
                <a class="btn btn-warning" id="lock_acc_list">
                    <span class="glyphicon glyphicon-lock"></span> khoá
                </a>
                <a class="btn btn-success" id="unlock_acc_list">
                    <span class="glyphicon glyphicon-lock"></span> Mở khoá
                </a> 
                <a class="btn btn-danger" id="del_acc_list">
                    <span class="glyphicon glyphicon-trash"></span> Xoá
                </a> 
            ';
            $sql_get_list_acc = "SELECT * FROM accounts WHERE position = '1' ORDER BY id_acc DESC";
            if ($db->numrow($sql_get_list_acc)) {
            	$data_user= $db->getData($sql_get_list_acc);
            	echo '
            	<br>
            	<br>
            	<div class="table-responsive">
            		<table class="table table-striped list" id="list_acc">
            			<tr>
            				<td><input type="checkbox"></td>
		                    <td><strong>ID</strong></td>
		                    <td><strong>Tên đăng nhập</strong></td>
		                    <td><strong>Trạng thái</strong></td>
		                    <td><strong>Tools</strong></td>
            			</tr>';
            	foreach ($data_user as $key => $value) {
            		if ($value['status']==1) {
            			$status='<label class="label label-warning">Khóa</label>';
            		}else{
            			$status='<label class="label label-success">Đang hoạt động</label>';
            		}
            		echo '
            			<tr>
            				<td><input value="'.$value['id_acc'].'" type="checkbox"></td>
            				<td>'.$value['id_acc'].'</td>
            				<td>'.$value['display_name'].'</td>
            				<td>'.$status.'</td>
            				<td>
            					<a data-id="'.$value['id_acc'].'" class="btn btn-success unlock_acc_list" >
				                    <span class="glyphicon glyphicon-lock"></span>
				                </a>
				                <a data-id="'.$value['id_acc'].'" class="btn btn-warning lock_acc_list" >
				                    <span class="glyphicon glyphicon-lock"></span>
				                </a>
            					<a data-id="'.$value['id_acc'].'" class="btn btn-danger del_acc_list" >
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
            }else{
            	echo '
            	<br>
            	<br>
            	<div class="alert alert-danger">Không có tài khoản nào</div>';
            }
        }
	}
}
 ?>