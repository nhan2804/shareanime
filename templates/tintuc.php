<div class="col md-9 lg-9 sm-12">
	<div class="row">
		<?php 
		$sqlGetpost = "SELECT id_post FROM posts WHERE status = '1'";
	    $countPost = $db->numrow($sqlGetpost);
	    if (isset($_GET['n'])) {
	    	$page = trim(addslashes(htmlspecialchars($_GET['n'])));
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
	    $sql_get_news = "SELECT * FROM posts WHERE status = '1' ORDER BY id_post DESC LIMIT $start, $limit";
	    if ($db->numrow($sql_get_news)) {
	    	foreach ($db->getData($sql_get_news) as $key => $value) {
	    	echo '
	            <div class="col md-6 lg-6 sm-12 margin">
	                <div class="row">
	                    <div class="col md-4 lg-4 sm-12">
	                        <img src="../'.$value['url_thumb'].'" alt="'.$value['url_thumb'].'">
	                    </div>
	                    <div class="col md-8 lg-8 sm-12">
	                        <a href="'.$_DOMAIN.$value['slug'].'-'.$value['id_post'].'.html"><h3 style="margin-top:0;">'.$value['title'].'</h3></a>
	                        <p>'.$value['descr'].'</p>
	                    </div>
	                </div>
	            </div>
	            ';
	    	}
	    }else{
	    	echo "<div >
	    		<h3>Hiện không có bài viết nào</h3>
	    	</div>";
	    }
	    ?>
	</div>
</div>