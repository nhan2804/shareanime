<div class="col lg-9 md-12 sm-12">
		<?php
		$sp = trim(htmlspecialchars(addslashes($_GET['sp'])));
		$id = trim(htmlspecialchars(addslashes($_GET['id'])));
		$ct = trim(htmlspecialchars(addslashes($_GET['ct'])));
		 $sql_get_lightnovel = "SELECT * FROM lightnovel WHERE id_lightnovel = '$id'";
		 $data_lightnovel = $db->getRow($sql_get_lightnovel);
		 $name_lightnovel = $data_lightnovel['name_lightnovel'];
		 $name_id =$data_lightnovel['author_id'];
		 $sql_get_author = "SELECT display_name FROM accounts WHERE id_acc = '$name_id'";
		 $name_author =$db->getRow($sql_get_author)['display_name'];
		 $url_ln =$data_lightnovel['url_lightnovel'];
		 $tmp_chapter =$ct;
		 $chapter_id=$ct;
		 $sql_get_chapter = "SELECT * from chapter WHERE id_lightnovel=$id and num_chapter='$chapter_id'";
		 $data_chapter = $db->getRow($sql_get_chapter);
		 $name_chapter=$data_chapter['name_chapter'];
		 $desrc_chapter= $data_chapter['desc_chapter'];
		 $content = $data_chapter['content_chapter'];
		 $time_up = $data_chapter['create_at'];
		 $view = $data_chapter['view'];
		 $name_session = 'chapter-'.$id.$ct;
		if (empty($_SESSION[$name_session])) {
			$_SESSION[$name_session]=1;
			$sql_view = "UPDATE chapter SET view = view + 1 WHERE id_lightnovel=$id and num_chapter='$chapter_id'";
			$db->statement($sql_view);
		}
		 echo '<div class="content_post">';
		 echo '<h3 style="text-align:center;">'.$name_chapter.'</h3>';
		 echo '<p style="text-align:center;">'.$desrc_chapter.'</p>
		 ';
		 echo '<div class="content_post"><p><b><i class="fas fa-user-tie"></i>Người đăng bài :</b> <i>'.$name_author.'</i>   |  <b><i class="far fa-clock"></i>Thời gian</b> : <i>'.$time_up.'</i>   |  '.$view .'<i class="fas fa-eye"></i> <i><b>Lượt xem</b></i> <p></div>';
		 echo htmlspecialchars_decode($content);
		 echo '<div style="display : flex; justify-content: space-between;align-items:center;">';
		 if ($chapter_id>1) {
		 	$ct--;
		 	echo '

		 	<a style="background: red;" class="btn" href="'.$_DOMAIN.'lightnovel/'.$url_ln.'-'.$id.'/'.($ct).'.html"><i class="fas fa-chevron-left"></i>Prev</a>';
		 	echo '<h3><a href="'.$_DOMAIN.'lightnovel/'.$url_ln.'-'.$id.'/1.html">'.$name_lightnovel.'</a></h3>';
		 }
		 $chapter_id++;
		 $sql_next_chapter = "SELECT * from chapter WHERE id_lightnovel=$id and num_chapter='$chapter_id'";
		 if ($db->numrow($sql_next_chapter)) {
		 	echo '<a class="btn" href="'.$_DOMAIN.'lightnovel/'.$url_ln.'-'.$id.'/'.$chapter_id.'.html">Next<i class="fas fa-chevron-right"></i></a>';
		 }
		 echo '
		 </div>
		 <ul class="all_chapter">
		 <h3 class="heading_all_chapter">Danh sách các tập <i class="fas fa-chevron-down"></i></h3>';
		 $sql_get_all_chap="SELECT num_chapter,name_chapter from chapter WHERE id_lightnovel=$id ";
		 foreach ($db->getData($sql_get_all_chap) as $key => $value) {
		 	if ($tmp_chapter==$value['num_chapter']) {
		 		echo '<li class="all_chapter_list active"><a class="all_chapter_link" href="'.$_DOMAIN.'lightnovel/'.$url_ln.'-'.$id.'/'.$value['num_chapter'].'.html">'.$value['num_chapter'].'.'.$value['name_chapter'].'</a></li>';
		 	}else{
		 	echo '<li class="all_chapter_list"><a class="all_chapter_link" href="'.$_DOMAIN.'lightnovel/'.$url_ln.'-'.$id.'/'.$value['num_chapter'].'.html">'.$value['num_chapter'].'.'.$value['name_chapter'].'</a></li>';
		 	}
		 }
		 echo '
		 </ul>
		 </div>
		 <br>
 	 	<div class="fb-like" data-href="https://www.facebook.com/IshtarFanArt/" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>
    	<div class="fb-comments" data-href="http://localhost'.$_SERVER['REQUEST_URI'].'" data-width="" data-numposts="5"></div>
    	
    	';
		 ?>
	</div>