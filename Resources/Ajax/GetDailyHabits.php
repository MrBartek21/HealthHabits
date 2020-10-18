<?php
    session_start();
	require_once("../Config.php");
	require_once("../Functions.php");
	require_once("../Subtitles.php");

	$UserID = $_SESSION['HH_ID'];

	$result = mysqli_query($Connect, "SELECT * FROM userhabits WHERE UserID='$UserID'");
	$count = $result->num_rows;
    if($count>0){
		$result = mysqli_query($Connect, "SELECT * FROM userhabits WHERE UserID='$UserID' ORDER BY HabitsID");
		while($row=mysqli_fetch_array($result)){
			$HabitsID = $row['HabitsID'];
			$UpdateTime = $row['UpdateTime'];

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


			$result2 = mysqli_query($Connect, "SELECT * FROM habits WHERE ID='$HabitsID'");
    		$row = $result2->fetch_assoc();
			$Type = $row['Type'];
			
			if($Type==1){
				$Name = $row['Name'];
				$Color = $row['Color'];
				$Icon = $row['Icon'];
				$ColorDarker = adjustBrightness($Color, -40);

				$List .= '
					<div class="row">
						<div class="col-8">
						<span class="fa-stack fa-2x">
						<i class="fa fa-circle fa-stack-2x" style="color: #'.$ColorDarker.';"></i>
						<i class="'.$Icon.' fa-stack-1x"></i>
					</span>
					<figure class="figure">
						<B class="figure-img rounded">'.$Name.'</B>
						<figcaption class="figure-caption">'.$UpdateTime.'</figcaption>
					</figure>
						</div>
						<div class="col-4">
							<button type="button" class="btn btn-success btn-block btn-lg" data-toggle="modal" data-target="#UpdateWeight">Aktualizuj</button>
						</div>
					</div>';
			}
		}

		echo $List;
	}
?>