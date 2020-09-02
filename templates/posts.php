<?php 
$sp = trim(htmlspecialchars(addslashes($_GET['sp'])));
$id = trim(htmlspecialchars(addslashes($_GET['id'])));
$sql_get_post = "SELECT * FROM posts WHERE id_post = '$id'";
if ($db->numrow($sql_get_post)) {
	$data_post = $db->getRow($sql_get_post);
	$body = $data_post['body'];
	$id_acc = $data_post['author_id'];
	$time_up = $data_post['date_posted'];
	$view = $data_post['view'];
	$url=$data_post['url_thumb'];
}else{
	require 'templates/404.php';
    exit;
}
$name_session = 'post-'.$id;
if (empty($_SESSION[$name_session])) {
	$_SESSION[$name_session]=1;
	$sql_view = "UPDATE posts SET view = view + 1 WHERE id_post='$id'";
	$db->statement($sql_view);
}
 ?>
 		<div class="col lg-9 md-12 sm-12">
 			
 			<?php 
 			$sql_get_name = "SELECT * FROM accounts WHERE id_acc = '$id_acc'";
 			if ($db->numrow($sql_get_name)) {
 				$data_info = $db->getRow($sql_get_name);
 				$name= $data_info['display_name'];
 				echo '<div class="content_post"><p><b><i class="fas fa-user-tie"></i>Người đăng bài :</b> <i>'.$name.'</i>   |  <b><i class="far fa-clock"></i>Thời gian</b> : <i>'.$time_up.'</i>   |  '.$view .'<i class="fas fa-eye"></i> <i><b>Lượt xem</b></i> <p></div>';
 			}
 			 ?>
 			 <h1><?php echo $data_post['title']; ?></h1>
 			<?php echo '<img class="img_post_desrc" src="'.$url.'" alt="cc">' ?>
				
 			<br>
			<div class="content_post"><?php echo htmlspecialchars_decode($data_post['body']); ?></div>
<?php 
$reference='';
for ($i=1; $i <=3 ; $i++) { 
	$cate = $data_post['cate_'.$i.'_id'];
	if ($cate) {
		$sql="SELECT label, url FROM categories WHERE id_cate = '$cate' AND type = '$i'";
		if ($db->numrow($sql)) {
			$data=$db->getRow($sql);
			$reference .='<a class="tag" href="'.$_DOMAIN.'categories/'.$data['url'].'">'.$data['url'].'</a>';
		}
	}
}
echo '<h4 style="margin :0;" >tag</h4><br>';
echo $reference;
echo "<h3>Bài viết liên quan</h3>";
echo '<div class="row">';
 ?>
 	<?php 
 	$sql_get_invole_post = "SELECT DISTINCT * FROM posts WHERE (cate_1_id = '$data_post[cate_1_id]' OR cate_2_id = '$data_post[cate_2_id]' OR cate_3_id = '$data_post[cate_3_id]') AND status = '1' AND id_post != '$id' Limit 3";
 	if ($db->numrow($sql_get_invole_post)) {
 		foreach ($db->getData($sql_get_invole_post) as $key => $value) {	
    	echo '
            <div class="col md-12 lg-12 sm-12 margin">
                <div class="row">
                    <div class="col md-4 lg-4 sm-4">
                        <img src="'.$value['url_thumb'].'" alt="'.$value['url_thumb'].'">
                    </div>
                    <div class="col md-6 lg-6 sm-6">
                        <a href="'.$_DOMAIN.$value['slug'].'-'.$value['id_post'].'.html"><h3 style="margin-top:0;">'.$value['title'].'</h3></a>
                        <p>'.$value['descr'].'</p>
                    </div>
                </div>
            </div>
            ';
    		}
    	}
 	 ?>
 	 	
 	 </div>
 	 <?php echo '
 	 	<div class="fb-like" data-href="http://localhost'.$_SERVER['REQUEST_URI'].'" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>
    	<div class="fb-comments" data-href="http://localhost'.$_SERVER['REQUEST_URI'].'" data-width="" data-numposts="5"></div>
    	'; ?>
 	 </div>