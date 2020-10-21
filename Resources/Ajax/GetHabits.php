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
						$OK = false;
					}else{
						$OK = true;
					}

					if($OK){
						$Onclick = '';
						$Pointer = '';
					}else{
						$Pointer = 'pointer';
						$Onclick = 'onClick="UpdateHabit('.$HabitsID.', '.$UserID.')"';
					}
					
				}else{
					$Pointer = 'pointer';
					$Onclick = 'onClick="UpdateHabit('.$HabitsID.', '.$UserID.')"';
				}
				
			}

			$expUVR = round($expUV);

			$List .= '
			<div class="row">
				<div class="col-8">
					<figure class="figure">

						<span class="fa-stack fa-2x figure-img '.$Pointer.'" '.$Onclick.'>
							<i class="fa fa-circle fa-stack-2x" style="color: #'.$Color.'; z-index: 50000;"></i>
							<i class="'.$Icon.' fa-stack-1x" style="z-index: 50000;"></i>


							<div class="progress blue">
								<span class="progress-left">
									<span class="progress-bar"></span>
								</span>
								<span class="progress-right">
									<span class="progress-bar"></span>
								</span>
								<div class="progress-value">90%</div>
							</div>

							
						</span>
						<B class="figure-img rounded">'.$Name.'</B>
						<!--<figcaption class="figure-caption">'.$UpdateTime.'</figcaption>/--!>
					</figure>
				</div>
				<!--<div class="col-4">'.$Button.'</div>/--!>
				<div class="col-4">'.$UpdateTime.' <span id="UpdateHabit'.$HabitsID.'"></span></div>
			</div>

			<!--<div class="col-lg-12">
				<div class="card h-100 card-curved-lg text-dark" style="background-color: #'.$Color.'; padding: 0px !important;">
					<div class="card-body">
						
					</div>
				</div>
			</div>/--!>';

			
		}

		echo $List;
	}else{
		echo '<div class="alert alert-warning text-center" role="alert">'.$SB['zero_habbits'].'</div>';
	}
?>