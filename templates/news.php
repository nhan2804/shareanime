<div class="col lg-9 md-12">
    <span style="font-size: 1.4rem;color: #F31010">CHIA SẺ VỚI BẠN BÈ </span><div class="fb-share-button" data-href="https://www.facebook.com/IshtarFanArt" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.facebook.com%2FIshtarFanArt&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ </a></div>
	<div class="row">
	<?php 
	$sqlGetpost = "SELECT id_post FROM posts WHERE status = '1'";
    $sqlGetln = "SELECT id_lightnovel FROM lightnovel ";
    $countPost = $db->numrow($sqlGetpost);
    $countLn = $db->numrow($sqlGetln);
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
    $totalPage=ceil($countLn/$limit);
    if ($page>$totalPage) {
    	$page=$totalPage;
    }else if ($page<1) {
    	$page=1;
    }
    $sql_get_ln_view="SELECT * FROM lightnovel ORDER BY view DESC LIMIT 0, 4";
    echo' 
    <div class="col md-12 lg-12 sm-12 margin ">
        <div class="slide">
        <ul class="slide_list">';
        foreach ($db->getData($sql_get_ln_view) as $key => $value) {
            $sql_get_new_chapter = "SELECT  num_chapter,name_chapter from chapter WHERE id_lightnovel='$value[id_lightnovel]' ORDER BY  num_chapter DESC";
            $sql_get_chapter1="SELECT SUM(view) as total_view from chapter WHERE id_lightnovel = '$value[id_lightnovel]'";
            $data_view = $db->getRow($sql_get_chapter1);
            $total_view = $data_view['total_view'];
            $data_new_chap =$db->getRow($sql_get_new_chapter );
            $new_chap = $data_new_chap['num_chapter'];
            echo '
            <li class="slide_item">
                <a class="slide_link" href="'.$_DOMAIN.'lightnovel/'.$value['url_lightnovel'].'-'.$value['id_lightnovel'].'/'.$new_chap.'.html">
                    <img class="slide_img" src="'.$value['img_lightnovel'].'" alt="'.$value['img_lightnovel'].'">
                    <p class="num_chapter">'.$new_chap.'/?</p>
                    <div class="slide_meta">
                        <h4 class="slide_title">'.$value['name_lightnovel'].'</h4>
                        <p class="total_view"><i style="color :black;" class=" fas fa-eye"></i>'.$total_view.'</p>
                        
                    </div>
                </a>
            </li>
            ';
        }
    echo '
       </ul>
       <button class="prev"><span class="fas fa-angle-left"></span></button> 
        <button class="next"><span class="fas fa-angle-right"></span></button>
        </div>
    <h3>Tin mới nhất</h3> 
    </div>';
    $start=($page-1)*$limit;
    $sql_get_news = "SELECT * FROM posts WHERE status = '1' ORDER BY id_post DESC LIMIT 0, 2";

    if ($db->numrow($sql_get_news)) {
    	foreach ($db->getData($sql_get_news) as $key => $value) {
    	echo '
            <div class="col md-12 lg-12 sm-12 margin load">
                <div class="list_post">
                    <div class="row">
                        <div class="col md-4 lg-4 sm-4">
                            <div class="img_news">
                            <img src="'.$value['url_thumb'].'" alt="'.$value['url_thumb'].'">
                            <h4 class="tintucanime">TIN TỨC ANIME</h4>
                            </div>
                        </div>
                        <div class="col md-8 lg-8 sm-8">
                            <a href="'.$_DOMAIN.$value['slug'].'-'.$value['id_post'].'.html"><h3 style="margin-top:0;">'.$value['title'].'</h3></a>
                            <div>
                                <p>'.$value['descr'].'</p>
                                <i>'.$value['date_posted'].'</i>
                            </div>
                        </div>
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
    echo '
    <input style="margin :0 auto;" type="submit" onsubmit="return false;" class="btn" id="load_more" value="Xem thêm" />
    <input type="hidden" id="row_now" value="0" />
    <input type="hidden" id="row_all" value="'.$countPost.'" />
    </div>
    <h3>Light Novel</h3>
    ';

    $sql_get_ln = "SELECT * FROM lightnovel ORDER BY id_lightnovel DESC LIMIT $start, $limit";
    echo '<div class="row">';
    if ($db->numrow($sql_get_ln)) {
        foreach ($db->getData($sql_get_ln) as $key => $value1) {
            $sql_get_new_chapter = "SELECT  Num_Chapter,Name_Chapter from chapter WHERE Id_lightnovel='$value1[id_lightnovel]' ORDER BY  Num_Chapter DESC";
            $data_new_chap =$db->getRow($sql_get_new_chapter );
            $new_chap = $data_new_chap['Num_Chapter'];
            
        echo '
            <div class="col md-4 lg-3 sm-6 margin">
                <div class="post">
                    <div class="title_img">
                        <a href="'.$_DOMAIN.'lightnovel/'.$value1['url_lightnovel'].'-'.$value1['id_lightnovel'].'.html">
                            <img class="img_post" width="auto" height="100px" src="'.$value1['img_lightnovel'].'" alt="ssssss">
                        </a>
                    </div>
                    <div class="descr_post">
                    <a href="'.$_DOMAIN.'lightnovel/'.$value1['url_lightnovel'].'-'.$value1['id_lightnovel'].'/'.$new_chap.'.html"><h4>'.$value1['name_lightnovel'].'</h4></a>
                        <p class="descr_text">'.$value1['descr_lightnovel'].'</p>
                    </div>
                    <h3 class="title_post">'.$value1['name_lightnovel'].'</h3>
                </div>
            </div>
            
            ';
        }
    }
    echo "</div>";
    echo '<div style="display: flex;
    justify-content: center;">
    <div>';
    if ($page>1 && $totalPage>1) {
    	echo '
                <a href="' . $_DOMAIN . ($page - 1 ) . '" class="pagination">
                Prev </span>
                </a>
            ';
    }
	  for ($i=1; $i <=$totalPage ; $i++) {
	  	if ($i == $page){
	        echo '<a class="pagination active_pagi">'.$i.'</a>';
	    } else {
	        echo '
	            <a href="' . $_DOMAIN . $i . '" class="pagination">
	                ' . $i . '
	            </a>';
	    }
	  }
	  if ($page<$totalPage && $totalPage>1) {
	  	echo '
                <a href="' . $_DOMAIN . ($page + 1 ) . '" class="pagination">
                    <span class="fas fa-angle-right"></span>Next
                </a>
            ';
	  }
	 ?>
        </div>
    </div>
</div>