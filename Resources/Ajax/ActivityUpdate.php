<?php
    session_start();
    require_once("../Config.php");
    require_once("../Functions.php");
    require_once("../Subtitles.php");
    
    $Hour = $_GET['Hour'];
    $Min = $_GET['Min'];
    $ActivityID = $_GET['ActivityID'];
    $UserID = $_GET['UserID'];
    $HabitsID = $_GET['HabitsID'];

    print_r($_GET);


    $Time = $Min + ($Hour*60);

    //$Connect->query("INSERT INTO historyhabits VALUES (NULL, '$UserID', '$HabitsID', now())");
    //$Connect->query("UPDATE persona SET Score=Score+5 WHERE UserID='$UserID'");
    //echo $SB['can_be_updated'];

    $result = mysqli_query($Connect, "SELECT * FROM persona WHERE UserID='$UserID'");
	$row = $result->fetch_assoc();
	$Weight = $row['Weight'];
	$Kactivity = $row['SumKCAL'];
    $PPM = $row['PPM'];	
    
    $result = mysqli_query($Connect, "SELECT * FROM activitymet WHERE ID='$ActivityID'");
	$row = $result->fetch_assoc();
	$MET = $row['MET'];
	
    $kcal = ($MET/60)*$Weight*$Time;
    $pkt = $kcal *0.1/2;
    $Kactivity += $kcal;
    $CPM = CPM($PPM, $Kactivity);
    $PAL = PAL($PPM, $CPM);

    /*echo $pkt."<br>";
    echo $CPM."<br>";
    echo $PAL."<br>";
    echo $Kactivity."<br>";*/

    $Connect->query("UPDATE persona SET SumKCAL='$Kactivity', Score=Score+'$pkt', CPM='$CPM', PAL='$PAL' WHERE UserID='$UserID'");
    $Connect->query("INSERT INTO useractivity VALUES (NULL, '$UserID', '$ActivityID', '$Time', '$kcal', now())");

    $Connect->query("INSERT INTO historyhabits VALUES (NULL, '$UserID', '$HabitsID', now())");

?>