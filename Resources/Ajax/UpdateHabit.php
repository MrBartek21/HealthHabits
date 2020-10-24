<?php
    session_start();
    require_once("../Config.php");
    require_once("../Functions.php");
    require_once("../Subtitles.php");
    
    $HabitsID = $_GET['HabitsID'];
    $UserID = $_GET['UserID'];
    $Series = $_GET['Series'];

    if($HabitsID==$WaterID) $Connect->query("INSERT INTO historyhabits VALUES (NULL, '$UserID', '$HabitsID', now(), '$Series', 100)");
    else $Connect->query("INSERT INTO historyhabits VALUES (NULL, '$UserID', '$HabitsID', now(), '$Series', 0)");
    
    $Connect->query("UPDATE persona SET Score=Score+5 WHERE UserID='$UserID'");
    PlantLevel($Connect, $UserID);
    echo "OK: ".$HabitsID;
?>