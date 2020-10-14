<?php
	$Host = "localhost";
	$DB_User = "mysqladmin";
	$DB_Password = "mysqladmin";
	
	$DB_Name_HH = 'p_healthhabbits';
	
	$Connect_HH = @new mysqli($Host, $DB_User, $DB_Password, $DB_Name_HH);
    $Connect_HH->set_charset("utf-8");
?>