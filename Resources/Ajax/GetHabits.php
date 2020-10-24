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
			$Series = $row['Series'];

			if($UpdateTime==""){
				$Series = 1;
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
							$Series = $Series + 1;
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

			$ProgressText = $Precent."%";

			if($Type==2){
				$Pointer = 'pointer';
				$Onclick = 'data-toggle="modal" data-target="#UpdateWeight"';
			}elseif($Type==1){
				$Pointer = 'pointer';
				$Onclick = 'data-toggle="modal" data-target="#UpdateActivity"';
			}else{
				$result4 = mysqli_query($Connect, "SELECT COUNT(*) FROM `historyhabits` WHERE `UpdateTime` LIKE '%$YearNow-$MonthNow-$DayNow%' AND `HabitsID` = '$HabitsID' AND `UserID` = '$UserID' ORDER BY ID DESC");
				$row = $result4->fetch_assoc();
				$Count = $row['COUNT(*)'];

				if($Count>=1){
					if($HabitsID==$WaterID){
						$Pointer = 'pointer';
						$Onclick = 'onClick="UpdateHabit('.$HabitsID.', '.$UserID.', '.$Series.')"';


						$result6 = mysqli_query($Connect, "SELECT * FROM persona WHERE UserID='$UserID'");
    					$row = $result6->fetch_assoc();
						$Min_water = $row['Min_water'];
						$Water = GetWater($Connect, $UserID, $WaterID);
						$Precent = round(($Water/$Min_water)*100);
						$ProgressText = $Water."ml / ".$Min_water."ml";
					}else{
						$Onclick = '';
						$Pointer = '';
					}
				}else{
					$Pointer = 'pointer';
					$Onclick = 'onClick="UpdateHabit('.$HabitsID.', '.$UserID.', '.$Series.')"';
				}
			}

			$List .= '
			<div class="row">
				<div class="col-12">
					<figure class="figure">
						<span class="fa-stack fa-2x figure-img '.$Pointer.'" '.$Onclick.'>
							<i class="fa fa-circle fa-stack-2x" style="color: #'.$Color.';"></i>
							<i class="'.$Icon.' fa-stack-1x"></i>
						</span>
						<B class="figure-img rounded">'.$Name.'</B>
					</figure>
					<div class="progress">
						<div class="progress-bar text-dark" role="progressbar" aria-valuenow="'.$Precent.'"
						aria-valuemin="0" aria-valuemax="100" style="width:'.$Precent.'%;"><B>'.$ProgressText.'</B></div>
					</div>
				</div>
				<hr>
			</div>';
		}
		echo $List;
	}else echo '<div class="alert alert-warning text-center" role="alert">'.$SB['zero_habbits'].'</div>';
?>