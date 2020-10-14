<?php
	$host = "localhost";
	$db_user = "mysqladmin";
	$db_password = "mysqladmin";
	
	$db_name = "losso";
	
	$_SESSION['db_host'] = $host;
	$_SESSION['db_user'] = $db_user;
	$_SESSION['db_password'] = $db_password;
	
	$_SESSION['db_name_main'] = $db_name;
	
	
	$connect = @new mysqli($host, $db_user, $db_password, $db_name);
	$connect->set_charset("utf-8");
?>