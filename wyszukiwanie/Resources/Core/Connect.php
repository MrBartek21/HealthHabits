<?php
    
    $Host = "localhost";
	$DB_User = "mysqladmin";
	$DB_Password = "mysqladmin";
	$DB_Name = "p_healthhabbits";
	
	
	$Connect = @new mysqli($Host, $DB_User, $DB_Password, $DB_Name);
    $Connect->set_charset("utf-8");
?>