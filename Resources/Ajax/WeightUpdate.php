<?php
    session_start();
    require_once("../Config.php");
    require_once("../Functions.php");
    require_once("../Subtitles.php");
    
    $Weight = $_GET['Weight'];
    $UserID = $_GET['UserID'];
    
    $result = mysqli_query($Connect, "SELECT * FROM habits WHERE Name='Waga'");
    $row = $result->fetch_assoc();
    $HabitsID = $row['ID'];


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

    $Connect->query("INSERT INTO historyhabits VALUES (NULL, '$UserID', '$HabitsID', now(), '$Series')");

    $result = mysqli_query($Connect, "SELECT * FROM persona WHERE UserID='$UserID'");
    $row = $result->fetch_assoc();
    $Height = $row['Height'];
    $Sex = $row['Sex'];
    $Kactivity = $row['SumKCAL'];
    
    $BMI2 = BMI($Weight, $Height);
    $BMI = $BMI2[0];
    $pkt = $BMI2[1];
    $MinWater = MinWater($Weight);
    $LBM = LBM($Weight, $Height, $Sex);
    $PPM = PPM($LBM);
    $CPM = CPM($PPM, $Kactivity);
    $PAL = PAL($PPM, $CPM);
    

    $Connect->query("UPDATE persona SET Score=Score+'$pkt' WHERE UserID='$UserID'");
    $Connect->query("UPDATE persona SET Weight='$Weight' WHERE UserID='$UserID'");
    $Connect->query("UPDATE persona SET Height='$Height' WHERE UserID='$UserID'");
    $Connect->query("UPDATE persona SET Min_water='$MinWater' WHERE UserID='$UserID'");
    $Connect->query("UPDATE persona SET BMI='$BMI' WHERE UserID='$UserID'");
    $Connect->query("UPDATE persona SET LBM='$LBM' WHERE UserID='$UserID'");
    $Connect->query("UPDATE persona SET PPM='$PPM' WHERE UserID='$UserID'");
    $Connect->query("UPDATE persona SET CPM='$CPM' WHERE UserID='$UserID'");
    $Connect->query("UPDATE persona SET PAL='$PAL' WHERE UserID='$UserID'");

    $Connect->query("INSERT INTO historypersona VALUES (NULL, '$UserID', '$Weight', '$Height', '$MinWater', '$BMI', '$LBM', '$PPM', '$CPM', now())");

    PlantLevel($Connect, $UserID);

    if($Sex=='K') echo '<div class="alert alert-success text-center" role="alert">'.$SB['habits_updated_k'].'</div>';
    else echo '<div class="alert alert-success text-center" role="alert">'.$SB['habits_updated_m'].'</div>';
?>