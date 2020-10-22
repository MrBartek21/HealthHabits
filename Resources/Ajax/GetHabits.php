<?php
    session_start();
	require_once("../Config.php");
	require_once("../Functions.php");
	require_once("../Subtitles.php");

	$UserID = $_SESSION['HH_ID'];

	$result = mysqli_query($Connect, "SELECT * FROM habitsuser WHERE UserID='$UserID'");
	$count = $result->num_rows;
    if($count>0){
		$result = mysqli_query($Connect, "SELECT * FROM habitsuser WHERE UserID='$UserID' ORDER BY HabitsID");
		while($row=mysqli_fetch_array($result)){
			$HabitsID = $row['HabitsID'];

			$result2 = mysqli_query($Connect, "SELECT * FROM historyhabits WHERE UserID='$UserID' AND HabitsID='$HabitsID' ORDER BY ID DESC");
    		$row = $result2->fetch_assoc();
			$UpdateTime = $row['UpdateTime'];

			if($UpdateTime==""){
				$UpdateTime = $SB['no_update'];
				$Series = 0;
				$Precent = 0;
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
					$Precent = 0;
				}else{
					if($MonthNow-$UpdateMonth>0){
						$Series = 0;
						$Precent = 0;
					}else{
						if($DayNow-$UpdateDay>0){
							$Series = 0;
							$Precent = 0;
						}else{
							$Series = 1;
							$Precent = 100;
						}
					}
				}
			}

			$result2 = mysqli_query($Connect, "SELECT * FROM habits WHERE ID='$HabitsID'");
    		$row = $result2->fetch_assoc();
			$Name = $row['Name'];
			$Type = $row['Type'];
			$Color = $row['Color'];
			$Icon = $row['Icon'];
			$ColorDarker = adjustBrightness($Color, -40);

			$result3 = mysqli_query($Connect, "SELECT * FROM habits WHERE Name='Woda'");
			$row = $result3->fetch_assoc();
			$IDWater = $row['ID'];

			if($Type==2){
				$Pointer = 'pointer';
				$Onclick = 'data-toggle="modal" data-target="#UpdateWeight"';
			}elseif($Type==1){
				$Pointer = 'pointer';
				$Onclick = 'data-toggle="modal" data-target="#UpdateActivity"';
			}else{
				if($Series==1){
					if($HabitsID==$IDWater){
						$Pointer = 'pointer';
						$Onclick = 'onClick="UpdateHabit('.$HabitsID.', '.$UserID.')"';

						$result3 = mysqli_query($Connect, "SELECT COUNT(*) FROM `historyhabits` WHERE `UpdateTime` LIKE '%$YearNow-$MonthNow-$DayNow%' AND `HabitsID` = '$IDWater' AND `UserID` = '$UserID'");
						$row = $result3->fetch_assoc();
						$Count = $row['COUNT(*)'];
						$Precent = round(($Count/6)*100);
					}else{
						$Onclick = '';
						$Pointer = '';
					}
					
				}else{
					$Pointer = 'pointer';
					$Onclick = 'onClick="UpdateHabit('.$HabitsID.', '.$UserID.')"';
				}
				
			}

			if($Precent>=50 && $Precent<75) $ProgressBar = "yellow";
			elseif($Precent>=75 && $Precent<99) $ProgressBar = "blue";
			elseif($Precent>99) $ProgressBar = "green";
			else $ProgressBar = "red";

			$List .= '
			<div class="row">
				<div class="col-8">
					<figure class="figure">
						<span class="fa-stack fa-2x figure-img '.$Pointer.'" '.$Onclick.'>
							<i class="fa fa-circle fa-stack-2x" style="color: #'.$Color.';"></i>
							<i class="'.$Icon.' fa-stack-1x"></i>
						</span>
						<B class="figure-img rounded">'.$Name.'</B>
					</figure>

				</div>
				<!--<div class="col-4">'.$UpdateTime.' <span id="UpdateHabit'.$HabitsID.'"></span></div>/--!>
				<div class="col-4">
					<div class="progress" style="margin-top: 25px;">
						<div class="progress-bar" role="progressbar" aria-valuenow="'.$Precent.'"
						aria-valuemin="0" aria-valuemax="100" style="width:'.$Precent.'%; background-color: '.$ProgressBar.';">'.$Precent.'%</div>
					</div>
				</div>
			</div>';
		}

		echo $List;
	}else{
		echo '<div class="alert alert-warning text-center" role="alert">'.$SB['zero_habbits'].'</div>';
	}
?>