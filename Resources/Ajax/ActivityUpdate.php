<?php
    session_start();
    require_once("../Config.php");
    require_once("../Functions.php");
    require_once("../Subtitles.php");
    
    $HabitsID = $_GET['HabitsID'];
    $UserID = $_GET['UserID'];

    print_r($_GET);


    //$Connect->query("INSERT INTO historyhabits VALUES (NULL, '$UserID', '$HabitsID', now())");
    //$Connect->query("UPDATE persona SET Score=Score+5 WHERE UserID='$UserID'");
    //echo $SB['can_be_updated'];

?>