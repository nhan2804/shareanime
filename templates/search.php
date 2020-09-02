<div class="col md-9 lg-9">
	<?php
	 	$s = trim(addslashes(htmlspecialchars($_GET['search'])));
	 	$sqlGetCountPost = "SELECT * FROM lightnovel WHERE name_lightnovel LIKE '%$s%' ";
            $count = $db->numrow($sqlGetCountPost);
	 if (isset($_GET['p'])) {
	 	$page = trim(htmlspecialchars(addslashes($_GET['p'])));
              if (preg_match('/\d/', $page)) {
                $page = $page;
              } else {
                $page = 1;
              }
        } else {
          $page = 1;
        }
        $limit = 20;
        $totalPage=ceil($count/$limit);
	    if ($page>$totalPage) {
	    	$page=$totalPage;
	    }else if ($page<1) {
	    	$page=1;
	    }
	    $start=($page-1)*$limit;
	    $sqlGetPost = "SELECT * FROM lightnovel WHERE name_lightnovel LIKE '%$s%' OR descr_lightnovel LIKE '%$s%' LIMIT $start,$limit";
	    if ($db->numrow($sqlGetPost)) {
	    echo '<h3>Kết quả tìm kiếm cho '.$s.'</h3>
	    <div class="row">';
    	foreach ($db->getData($sqlGetPost) as $key => $value) {
    	echo '
            <div class="col md-4 lg-3 sm-6 margin">
                <div class="post">
                    <div class="title_img">
                        <a href="'.$_DOMAIN.'lightnovel/'.$value['url_lightnovel'].'-'.$value['id_lightnovel'].'.html">
                            <img class="img_post" width="auto" height="100px" src="'.$value['img_lightnovel'].'" alt="ssssss">
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
        echo "</div>";
    }else{
    	echo '
    	<h3>Không tìm thấy kết quả nào!</h3>

    	';
    }
	 ?>
</div>