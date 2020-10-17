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
			$Updated = $row['Updated'];

			$timestamp = strtotime($UpdateTime);
			$UpdateDay = date('d', $timestamp);
			$UpdateMonth = date('m', $timestamp);
			$UpdateYear = date('Y', $timestamp);
		
			$DayNow = date("d");
			$MonthNow = date("m");
			$YearNow = date("Y");

			if($Updated==0){
				//$Icon2 = '<i class="fas fa-times fa-2x" style="color: gray;"></i>';
				$UpdateTime = $SB['no_update'];
				$Series = 0;
			}else{
				if($YearNow-$UpdateYear>0){
					//$Icon2 = '<i class="fas fa-exclamation fa-2x" style="color: darkred;"></i>';
					$Series = 0;
				}else{
					if($MonthNow-$UpdateMonth>0){
						//$Icon2 = '<i class="fas fa-exclamation fa-2x" style="color: darkred;"></i>';
						$Series = 0;
					}else{
						if($DayNow-$UpdateDay>0){
							//$Icon2 = '<i class="fas fa-exclamation fa-2x" style="color: darkred;"></i>';
							$Series = 0;
						}else{
							//$Icon2 = '<i class="fas fa-check fa-2x" style="color: green;"></i>';
							$Series = 1;
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

			$List .= '
			<div class="col-lg-12">
				<div class="card h-100 card-curved-lg text-dark" style="background-color: #'.$Color.'">
					<div class="card-body">
					'.$Icon2.'
						<span class="fa-stack fa-2x">
							<i class="fa fa-circle fa-stack-2x" style="color: #'.$ColorDarker.';"></i>
							<i class="'.$Icon.' fa-stack-1x"></i>
						</span>
						<figure class="figure">
							<B class="figure-img rounded">'.$Name.'</B> Typ: '.$Type.'
							<figcaption class="figure-caption">'.$UpdateTime.'</figcaption>
						</figure>
						
					</div>
					<div class="card-footer">
						<button type="button" class="btn btn-success btn-block btn-lg" onClick="UpdateHabit('.$HabitsID.', '.$UserID.', '.$Series.')">Aktualizuj</button>
					</div>
				</div>
			</div>';
		}

		echo $List;
	}else{
		echo '<div class="alert alert-warning text-center" role="alert">'.$SB['zero_habbits'].'</div>';
	}
?>