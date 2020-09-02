<?php 
include_once 'core/init.php';
	$s= trim(addslashes(htmlspecialchars($_POST['search'])));
	$html= '';
	$sql="SELECT * FROM lightnovel WHERE name_lightnovel LIKE '%$s%' ";
	if ($db->numrow($sql)) {
	foreach ($db->getData($sql) as $key => $value) {
		$sql_get_new_chapter = "SELECT  Num_Chapter,Name_Chapter from chapter WHERE Id_lightnovel='$value[id_lightnovel]' ORDER BY  Num_Chapter DESC";
		 	$data_new_chap =$db->getRow($sql_get_new_chapter);
		 	$new_chap = $data_new_chap['Name_Chapter'];
		 	echo '<li class="desrc_popular" title="'.$value['descr_lightnovel'].'">
		 				<img class="img_popular" src="'.$value['img_lightnovel'].'"/>
		 				<div class="time_update">
				 		<a  class="link_popular" style="color:white;" href="'.$_DOMAIN.'lightnovel/'.$value['url_lightnovel'].'-'.$value['id_lightnovel'].'/1.html">'.$value['name_lightnovel'].'</a>
				 		<h4 class="new_chap">'.$new_chap.'</h4>
						</div>
						</li>
				 		';
	}
}else{
	echo '<div><span style="text-align:center;color:#918F8F;">Không tìm thấy kết quả nào</span></div>';
	}

 ?>