<div class="col-md-9">
	<?php 
	if (isset($_GET['tab'])) {
		$tab = trim(addslashes(htmlspecialchars($_GET['tab'])));
	}else{
		$tab='';
	}
	if ($tab!='') {
		if ($tab == 'profile')
	    {
	       include_once 'templates/profile.php';
	    }
	    else if ($tab == 'posts')
	    {
	        include_once 'templates/posts.php';
	    }
	    else if ($tab == 'picture')
	    {
	       include_once 'templates/picture.php';
	    }
	    else if ($tab == 'categories')
	    {
	        include_once 'templates/categories.php';
	    }
	    else if ($tab == 'setting')
	    {
	        include_once 'templates/setting.php';
	    }
	    else if ($tab == 'accounts'){
	    	include_once 'templates/accounts.php';
		}else if ($tab == 'lightnovel') {
			include_once 'templates/lightnovel.php';
		}
}else{
	        include_once 'templates/dashboard.php';
}
	 ?>
</div>