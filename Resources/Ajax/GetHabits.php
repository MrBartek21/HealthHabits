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
				$Button = '<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#UpdateWeight">Aktualizuj</button>';
			}elseif($Type==1){
				$Button = '<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#UpdateActivity">Wybierz</button>';
			}else{
				if($Series==1){
					if($HabitsID==$IDWater){
						$OK = false;
					}else{
						$OK = true;
					}

					if($OK) $Button = '<button type="button" class="btn btn-success btn-block disabled">Wykonano</button>';
					else $Button = '<button type="button" class="btn btn-success btn-block" onClick="UpdateHabit('.$HabitsID.', '.$UserID.')">Wykonaj</button>';
					
				}else{
					$Button = '<button type="button" class="btn btn-success btn-block" onClick="UpdateHabit('.$HabitsID.', '.$UserID.')">Wykonaj</button>';
				}
				
			}

			$List .= '
			<div class="col-lg-12">
				<div class="card h-100 card-curved-lg text-dark" style="background-color: #'.$Color.'; padding: 0px !important;">
					<div class="card-body">
						<div class="row">
							<div class="col-8">
								<figure class="figure">
									<span class="fa-stack fa-2x figure-img">
										<i class="fa fa-circle fa-stack-2x" style="color: #'.$ColorDarker.';"></i>
										<i class="'.$Icon.' fa-stack-1x"></i>
									</span>
									<B class="figure-img rounded">'.$Name.'</B>
									<figcaption class="figure-caption">'.$UpdateTime.'</figcaption>
								</figure>
							</div>
							<div class="col-4">'.$Button.'</div>
						</div>
					</div>
				</div>
			</div>';

			
		}

		echo $List;
	}else{
		echo '<div class="alert alert-warning text-center" role="alert">'.$SB['zero_habbits'].'</div>';
	}
?>