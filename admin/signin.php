<?php 
require_once 'core/init.php';
if (isset($_POST['user_signin']) && isset($_POST['pass_signin'])) {
	$user = trim(htmlspecialchars(addslashes($_POST['user_signin'])));
	$pass = trim(htmlspecialchars(addslashes($_POST['pass_signin'])));
	$show_alert = '<script>$("#formSignin .alert").removeClass("hidden");</script>';
    $hide_alert = '<script>$("#formSignin .alert").addClass("hidden");</script>';
    $success_alert = '<script>$("#formSignin .alert").attr("class", "alert alert-success");</script>';
    if ($user=='' || $pass=='') {
    	echo $show_alert."Vui lòng điền đầy đủ thông tin";
    }else{
    	$check_user= "SELECT username FROM accounts where username='$user'";
    	if ($db->numrow($check_user)) {
    		$pass= md5($pass);
    		$check_user_pass="SELECT username,password FROM accounts where username='$user' and password='$pass'";
    		if ($db->numrow($check_user_pass)) {
    			$check_user_pass_stt="SELECT username,password,status FROM accounts where username='$user' and password='$pass' and status='0'";
    			if ($db->numrow($check_user_pass_stt)) {
    				$session->send($user);
    				echo $success_alert.'Đăng nhập thành công.';
    				new redirect(str_replace('/admin','',$_DOMAIN));
    			}else{
    				 echo $show_alert.'Tài khoản của bạn đã bị khoá, vui lòng liên hệ quản trị viện để biết thêm thông tin chi tiết.';
    			}
    		}else{
    			echo $show_alert.'Mật khẩu không chính xác, vui lòng kiểm tra và đăng nhập lại.';
    		}
    	}else{
    		echo $show_alert.'Không tồn tại tài khoản này';
    	}
    }
}else{
	new redirect($_DOMAIN);
}
 ?>
