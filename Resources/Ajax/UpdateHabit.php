<?php
    session_start();
    require_once("../Config.php");
    require_once("../Functions.php");
    require_once("../Subtitles.php");
    
    $HabitsID = $_GET['HabitsID'];
    $UserID = $_GET['UserID'];
    $Series = $_GET['Series'];


    $Connect->query("INSERT INTO historyhabits VALUES (NULL, '$UserID', '$HabitsID', now(), '$Series')");
    $Connect->query("UPDATE persona SET Score=Score+5 WHERE UserID='$UserID'");
    PlantLevel($Connect, $UserID);
    echo "OK";
?>