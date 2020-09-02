<?php
include 'core/init.php'; 
if (isset($_POST['row_now'])) {

$limit = 2;
	$row_now= trim(addslashes(htmlspecialchars($_POST['row_now'])));
	$html= '';
	$sql= "SELECT * FROM posts WHERE status = '1' ORDER BY id_post DESC LIMIT $row_now, $limit";
	foreach ($db->getData($sql) as $key => $value) {
    	 $html.='
            <div class="col md-12 lg-12 sm-12 margin load">
                <div class="list_post">
                    <div class="row">
                        <div class="col md-4 lg-4 sm-12">
                            <div class="img_news">
                            <img src="'.$value['url_thumb'].'" alt="'.$value['url_thumb'].'">
                            <h4 class="tintucanime">TIN TỨC ANIME</h4>
                            </div>
                        </div>
                        <div class="col md-8 lg-8 sm-12">
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
    	echo $html;
    }else{
       new redirect($_DOMAIN);
    }

 ?>