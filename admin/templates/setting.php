<?php 
if ($user) {
	if ($datauser['position']==1) {
		echo '<div class="alert alert-danger">Bạn không có quyền vào trang này</div>';
	}else{
		echo '<h3>Cài đặt chung</h3>
		<div class="panel panel-default">
			<div class="panel-heading">
		        <h3 class="panel-title">Trang thái hoạt động</h3>
		    </div>
		    <div class="panel-body">
		    	<form method="POST" id="formstatus" onsubmit="return false;">';
		    	$sql_stt= "SELECT status FROM website";
		    	if ($db->numrow($sql_stt)) {
		    		$data=$db->getRow($sql_stt);
		    		if ($data['status']==0) {
		    			echo '
				            <div class="radio">
				                <label><input type="radio" value="1" name="stt_web"> Mở</label>
				            </div>
				            <div class="radio">
				                <label><input type="radio" value="0" name="stt_web" checked> Đóng</label>
				            </div>
				        ';
		    		}else{
		    			echo '
				            <div class="radio">
				                <label><input type="radio" value="1" name="stt_web" checked> Mở</label>
				            </div>
				            <div class="radio">
				                <label><input type="radio" value="0" name="stt_web" > Đóng</label>
				            </div>
				        ';
		    		}
		    	}
				echo '
						<button type="submit" class="btn btn-primary">Lưu</button><br><br>
            		<div class="alert alert-danger hidden"></div>
		    	</form>
		    </div>
		</div>';
		$sql_edit_info="SELECT title, descr, keywords FROM website";
		if ($db->numrow($sql_edit_info)) {
			$data_info=$db->getRow($sql_edit_info);
		echo '
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Chỉnh sửa thông tin Web</h3>
			</div>
			<div class="panel-body">
				<form method="POST" onsubmit="return false;" id="edit_info_web">
					<div class="form-group">
						<label>Tiêu đề Website</label>
						<input class="form-control" id="title_web" type="text" name="" value="'.$data_info['title'].'">
					</div>
					<div class="form-group">
						<label>Mô tả website</label>
						<input class="form-control" id="desrc_web" type="text" name="" value="'.$data_info['descr'].'">
					</div>
					<div class="form-group">
						<label>Từ khoá website</label>
						<input class="form-control" id="kw_web" type="text" name="" value="'.$data_info['keywords'].'">
					</div>
					<button class="btn-primary btn">Lưu thay đổi</button>
					<div class="alert alert-danger hidden"></div>
				</form>
			</div>
		</div>';
		}
	}
}else{
	new redirect($_DOMAIN);
}
 ?>
