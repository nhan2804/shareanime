<?php
require_once 'core/init.php';
if ($user) {
    if (isset($_POST['action'])){
        $action = trim(addslashes(htmlspecialchars($_POST['action'])));
        if ($action == 'add_acc'){
            $un_add_acc = trim(htmlspecialchars(addslashes($_POST['un_add_acc'])));
            $pw_add_acc = trim(htmlspecialchars(addslashes($_POST['pw_add_acc'])));
            $repw_add_acc = trim(htmlspecialchars(addslashes($_POST['repw_add_acc'])));
            $show_alert = '<script>$("#formAddAcc .alert").removeClass("hidden");</script>';
            $hide_alert = '<script>$("#formAddAcc .alert").addClass("hidden");</script>';
            $success = '<script>$("#formAddAcc .alert").attr("class", "alert alert-success");</script>';
            $sql_check_un_exist = "SELECT username FROM accounts WHERE username = '$un_add_acc'";
 
            if ($un_add_acc == '' || $pw_add_acc == '' || $repw_add_acc == '') {
                echo $show_alert.'Vui lòng điền đầy đủ thông tin.';
            } else if (strlen($un_add_acc) < 6 || strlen($un_add_acc) > 32) {
                echo $show_alert.'Tên đăng nhập nằm trong khoảng 6-32 ký tự.';
            } else if (preg_match('/\W/', $un_add_acc)) {
                echo $show_alert.'Tên đăng nhập không chứa kí tự đặc biệt và khoảng trắng.';
            } else if ($db->numrow($sql_check_un_exist)) {
                echo $show_alert.'Tên đăng nhập đã tồn tại.';
            } else if (strlen($pw_add_acc) < 6) {
                echo $show_alert.'Mật khẩu quá ngắn.';
            } else if ($pw_add_acc != $repw_add_acc) {
                echo $show_alert.'Mật khẩu nhập lại không khớp.';
            } else {
                $pw_add_acc = md5($pw_add_acc);
                $sql_add_acc = "INSERT INTO accounts VALUES (
                    '',
                    '$un_add_acc',
                    '$pw_add_acc',
                    '',
                    '',
                    '1',
                    '0',
                    '$date_current',
                    '',
                    '',
                    '',
                    '',
                    '',
                    ''
                )";
                $db->statement($sql_add_acc);
                echo $show_alert.$success.'Thêm tài khoản thành công.';
                new redirect($_DOMAIN.'accounts'); // Trở về trang danh sách tài khoản
            }
        }else if($action=='del_list_acc'){
            foreach ($_POST['id_acc'] as $key => $value) {
                $sql= "SELECT id_acc from accounts WHERE id_acc='$value'";
                if ($db->numrow($sql)) {
                    $db->statement("DELETE from accounts WHERE id_acc='$value'");
                }
            }
        }else if ($action=='del_id_acc') {
            $id_acc = trim(htmlspecialchars(addslashes($_POST['id_acc'])));
            $sql= "SELECT id_acc from accounts WHERE id_acc='$id_acc'";
            if ($db->numrow($sql)) {
                 $db->statement("DELETE from accounts WHERE id_acc='$id_acc'");
            }
        }else if($action=='lock_list_acc'){
            foreach ($_POST['id_acc'] as $key => $value) {
                $sql= "SELECT id_acc from accounts WHERE id_acc='$value'";
                if ($db->numrow($sql)) {
                    $sql_lock_acc = "UPDATE accounts SET status = '1' WHERE id_acc = '$value'";
                    $db->statement($sql_lock_acc);
                }
            }
        }else if ($action=='lock_id_acc') {
            $id_acc = trim(htmlspecialchars(addslashes($_POST['id_acc'])));
            $sql= "SELECT id_acc from accounts WHERE id_acc='$id_acc'";
            if ($db->numrow($sql)) {
                $sql_unlock_acc = "UPDATE accounts SET status = '1' WHERE id_acc = '$id_acc'";
                 $db->statement($sql_unlock_acc);
            }
        }else if($action=='unlock_list_acc'){
            foreach ($_POST['id_acc'] as $key => $value) {
                $sql= "SELECT id_acc from accounts WHERE id_acc='$value'";
                if ($db->numrow($sql)) {
                    $sql_lock_acc = "UPDATE accounts SET status = '0' WHERE id_acc = '$value'";
                    $db->statement($sql_lock_acc);
                }
            }
        }else if ($action=='unlock_id_acc') {
            $id_acc = trim(htmlspecialchars(addslashes($_POST['id_acc'])));
            $sql= "SELECT id_acc from accounts WHERE id_acc='$id_acc'";
            if ($db->numrow($sql)) {
                $sql_unlock_acc = "UPDATE accounts SET status = '0' WHERE id_acc = '$id_acc'";
                 $db->statement($sql_unlock_acc);
            }
        }
        // Mở tài khoản
        // Khoá tài khoản
        // Xoá tài khoản
    }
    else{
        new Redirect($_DOMAIN); 
    }
}
else{
    new Redirect($_DOMAIN);
}