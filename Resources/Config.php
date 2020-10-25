<?php
	$Host = "classicgames.sytes.net";
	$DB_User = "mysqladmin";
	$DB_Password = "mysqladmin";
	$DB_Name = "p_healthhabbits";
	
	$Connect = @new mysqli($Host, $DB_User, $DB_Password, $DB_Name);
	$Connect->set_charset("utf-8");
	
	$WeightID = 1;
	$WaterID = 4;
	$ActivityID = 2;
    
	
	$Link = "http://".$_SERVER['SERVER_NAME'];
	$Keywords = "habits, health, game, plant, healthy";
	$Author = "Bartłomiej Pacyna, Patryk Ignasiak, Noemi Ignaczak, Adrian Sobiela";
	
	$Description = "W dzisiejszych czasach ludzie bardzo mocno dbają o swoje zdrowie i wygląd. Jest coraz więcej ludzi którzy marzą aby dożyć 100 a nawet więcej lat. Naszym głównym celem jest wsparcie ich w dążeniu do celu.";
	$Title = "Healthy Habits";
	$Title2 = "HealthyHabits";

    $Color = "ECEAE4";
?>