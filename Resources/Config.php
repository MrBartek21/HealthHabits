<?php
	$Host = "localhost";
	//$Host = "classicgames.sytes.net";
	$DB_User = "mysqladmin";
	$DB_Password = "mysqladmin";
	$DB_Name = "p_healthhabbits";
	
	
	$Connect = @new mysqli($Host, $DB_User, $DB_Password, $DB_Name);
    $Connect->set_charset("utf-8");
    
	
	$Link = "http://".$_SERVER['SERVER_NAME'];
	$Keywords = "habits, health, game";
	$Author = "Bartłomiej Pacyna, Patryk Ignasiak, Noemi Ignaczak, Adrian Sobiela";
	
	$Description = "Kiedy e.";
	$Title = "Healthy Habits";
	$Title2 = "HealthyHabits";

    $Color = "ffc5bf";
	
?>