<div class="col lg-9 md-12">
	<div class="row">
	<?php 
    if (isset($_GET['sc'])) {
        $sc = trim(addslashes(htmlspecialchars($_GET['sc'])));
        $sql_get_id = "SELECT id_cate, url FROM categories WHERE url='$sc'";
        $data=$db->getRow($sql_get_id);
        $id_cate=$data['id_cate'];
    }
	$sqlGetpost = "SELECT id_lightnovel FROM lightnovel WHERE cate_1_id = '$id_cate' OR cate_2_id = '$id_cate' OR cate_id_3 = '$id_cate' ";
    $countPost = $db->numrow($sqlGetpost);
    if (isset($_GET['p'])) {
    	$page = trim(addslashes(htmlspecialchars($_GET['p'])));
    	if (preg_match('/\d/', $page )) {
    		$page=$page;
    	}else{
    		$page=1;
    	}
    }else{
    	$page=1;
    }
    $limit = 10;
    $totalPage=ceil($countPost/$limit);
    if ($page>$totalPage) {
    	$page=$totalPage;
    }else if ($page<1) {
    	$page=1;
    }
    $start=($page-1)*$limit;
    $sql_get_news = "SELECT * FROM lightnovel WHERE cate_1_id = '$id_cate' OR cate_2_id = '$id_cate' OR cate_id_3 = '$id_cate' ORDER BY id_lightnovel DESC LIMIT $start, $limit";
    if ($db->numrow($sql_get_news)) {
    	foreach ($db->getData($sql_get_news) as $key => $value) {
    	echo '
    		<div class="col md-3 lg-3 margin">
    			<div class="post">
	    			<div class="title_img">
	    				<a href="'.$_DOMAIN.'lightnovel/'.$value['url_lightnovel'].'-'.$value['id_lightnovel'].'/1.html">
	    					<img class="img_post" width="auto" height="100px" src="../'.$value['img_lightnovel'].'" alt="'.$value['url_lightnovel'].'">
	    				</a>
	    			</div>
	    			<div class="descr_post">
	    			<a href="'.$_DOMAIN.'lightnovel/'.$value['url_lightnovel'].'-'.$value['id_lightnovel'].'/1.html"><h4>'.$value['name_lightnovel'].'</h4></a>
	    				<p class="descr_text">'.$value['descr_lightnovel'].'</p>
	    			</div>
                    <h3 class="title_post">'.$value['name_lightnovel'].'</h3>
    			</div>
    		</div>
    		';
    	}
    }else{
    	echo "<div >
    		<h3>Hiện không có bài viết nào</h3>
    	</div>";
    }
    echo "</div>";
    if ($page>1 && $totalPage>1) {
    	echo '
                <a href="' . $_DOMAIN . ($page - 1 ) . '" class="pagination">
                    <span class="fas fas-angle-left"></span>Pre
                </a>
            ';
    }
	  for ($i=1; $i <=$totalPage ; $i++) {
	  	if ($i == $page){
	        echo '<a class="pagination active">'.$i.'</a>';
	    } else {
	        echo '
	            <a href="' . $_DOMAIN . $i . '" class="pagination">
	                ' . $i . '
	            </a>';
	    }
	  }
	  if ($page<$totalPage && $totalPage>1) {
	  	echo '
                <a href="' . $_DOMAIN . ($page - 1 ) . '" class="pagination">
                    <span class="fas fas-angle-left"></span>Pre
                </a>
            ';
	  }
	 ?>
    
</div>