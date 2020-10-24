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

    $Time = $Min + ($Hour*60);

    $result = mysqli_query($Connect, "SELECT * FROM persona WHERE UserID='$UserID'");
	$row = $result->fetch_assoc();
	$Weight = $row['Weight'];
	$Kactivity = $row['SumKCAL'];
    $PPM = $row['PPM'];	
    $Sex = $row['Sex'];	
    
    $result = mysqli_query($Connect, "SELECT * FROM activitymet WHERE ID='$ActivityID'");
	$row = $result->fetch_assoc();
	$MET = $row['MET'];
	
    $kcal = ($MET/60)*$Weight*$Time;
    $pkt = $kcal *0.1/2;
    $Kactivity += $kcal;
    $CPM = CPM($PPM, $Kactivity);
    $PAL = PAL($PPM, $CPM);

    $Connect->query("UPDATE persona SET SumKCAL='$Kactivity', Score=Score+'$pkt', CPM='$CPM', PAL='$PAL' WHERE UserID='$UserID'");
    $Connect->query("INSERT INTO useractivity VALUES (NULL, '$UserID', '$ActivityID', '$Time', '$kcal', now())");

    $result2 = mysqli_query($Connect, "SELECT * FROM historyhabits WHERE UserID='$UserID' AND HabitsID='$HabitsID' ORDER BY ID DESC");
    $row = $result2->fetch_assoc();
	$UpdateTime = $row['UpdateTime'];
	$Series = $row['Series'];

	if($UpdateTime=="") $Series = 1;
	else{
		$timestamp = strtotime($UpdateTime);
		$UpdateDay = date('d', $timestamp);
        $UpdateMonth = date('m', $timestamp);
        $UpdateYear = date('Y', $timestamp);
		
		$DayNow = date("d");
		$MonthNow = date("m");
		$YearNow = date("Y");
	
        if($YearNow-$UpdateYear>0) $Series = 0;
        else{
			if($MonthNow-$UpdateMonth>0) $Series = 0;
			else{
                if($DayNow-$UpdateDay>0) $Series = 0;
                else $Series = $Series + 1;
			}
		}
	}

    $Connect->query("INSERT INTO historyhabits VALUES (NULL, '$UserID', '$HabitsID', now(), $Series)");

    if($Sex=='K') echo '<div class="alert alert-success text-center" role="alert">'.$SB['activity_updated_k'].'</div>';
    else echo '<div class="alert alert-success text-center" role="alert">'.$SB['activity_updated_m'].'</div>';

?>