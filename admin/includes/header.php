<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Anime Administration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <!-- Liên kết Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $_DOMAIN; ?>bootstrap/css/bootstrap.min.css"/> 
    <!-- Liên kết thư viện jQuery -->
    <script src="<?php echo $_DOMAIN; ?>js/jquery.min.js"></script>
</head>
<body>
	<?php
	if (!$user) {
	 	 echo
        '
            <div class="container">
                <div class="page-header">
                    <h1>Anime <small>Administration</small></h1>
                </div>
            </div>
        ';
	 }else{
	 	echo
        '
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="' . $_DOMAIN . '">Administration</a><span>|</span>
                        <a class="navbar-brand" href="http://localhost/shareanime/">Quay lại trang chủ</a>
                    </div><!-- div.navbar-header -->
                </div><!-- div.container-fluid -->
            </nav>
            <div class="container">
            	<div class="row">
        ';
	 } 
	 ?>