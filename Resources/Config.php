<?php
	$Host = "localhost";
	$DB_User = "mysqladmin";
	$DB_Password = "mysqladmin";
	$DB_Name = "p_healthhabbits";
	
	
	$Connect = @new mysqli($Host, $DB_User, $DB_Password, $DB_Name);
    $Connect->set_charset("utf-8");
    
	
	$Link = "http://".$_SERVER['SERVER_NAME'];
	$Keywords = "habits, health, game";
	$Author = "Bartłomiej Pacyna, Patryk Ignasiak, Noemi Ignaczak, Adrian Sobiela";
	
	$Description = "Kiedy e.";
	$Title = "Health Habits";
	$Title2 = "HealthHabits";
	
	
	$Color_Pink = "fadee1";
	$Color_Orange = "fad4ae";
	$Color_Yellow = "faf1d6";
	$Color_Red = "fdafab";
	$Color_Blue = "d9f1f1";
	$Color_Sea = "b6e3e9";
	$Color_Green = "b4e5c5";
	
    $Color = $Color_Green;
    
	
	
	
	
?>