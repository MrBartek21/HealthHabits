<?php
    session_start();
    require_once("../Config.php");
    require_once("../Functions.php");
    require_once("../Subtitles.php");
    
    $HabitsID = $_GET['HabitsID'];
    $UserID = $_GET['UserID'];


    $Connect->query("INSERT INTO historyhabits VALUES (NULL, '$UserID', '$HabitsID', now())");
    $Connect->query("UPDATE persona SET Score=Score+5 WHERE UserID='$UserID'");
    echo $SB['can_be_updated'];



   /* $result = mysqli_query($Connect, "SELECT * FROM habits WHERE ID='$HabitsID'");
    $row = $result->fetch_assoc();
    $ID = $row['ID'];
    $Type = $row['Type'];


    $result = mysqli_query($Connect, "SELECT * FROM habits WHERE Name='Woda'");
    $row = $result->fetch_assoc();
    $IDWater = $row['ID'];

    $result2 = mysqli_query($Connect, "SELECT * FROM historyhabits WHERE UserID='$UserID' AND HabitsID='$HabitsID'");
    $row = $result2->fetch_assoc();
    $UpdateTime = $row['UpdateTime'];
    
	if($UpdateTime==""){
		$Series = 0;
	}else{
		$timestamp = strtotime($UpdateTime);
		$UpdateDay = date('d', $timestamp);
		$UpdateMonth = date('m', $timestamp);
		$UpdateYear = date('Y', $timestamp);
			
		$DayNow = date("d");
        $MonthNow = date("m");
        $YearNow = date("Y");
	
		if($YearNow-$UpdateYear>0){
			$Series = 0;
		}else{
			if($MonthNow-$UpdateMonth>0){
				$Series = 0;
			}else{
				if($DayNow-$UpdateDay>0){
					$Series = 0;
				}else{
					$Series = 1;
				}
			}
		}
    }
    
    if($Series==0){
        $OK = true;
    }else{
        if($Type!=0){
            $OK = true;
        }else{
            if($ID==$IDWater){
                $OK = true;
            }else{
                $OK = false;
            }
        }
    }


    if($OK){
        $Connect->query("INSERT INTO historyhabits VALUES (NULL, '$UserID', '$HabitsID', now())");
        $Connect->query("UPDATE persona SET Score=Score+5 WHERE UserID='$UserID'");

        echo $SB['can_be_updated'];
    }else echo $SB['cannot_be_updated'];*/
?>