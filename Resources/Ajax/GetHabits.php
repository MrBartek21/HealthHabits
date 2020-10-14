<?php
    session_start();
	require_once("../Config.php");
	require_once("../Functions.php");

    $result = mysqli_query($Connect, "SELECT * FROM habits WHERE Type!=1");
	while($row=mysqli_fetch_array($result)){
		$Name = $row['Name'];
		$Type = $row['Type'];
		$Color = $row['Color'];
		$Icon = $row['Icon'];
		
	/*	$resultUser1 = mysqli_query($Connect_CG, "SELECT * FROM users WHERE ID='$UserID1'");
		$row = $resultUser1->fetch_assoc();
		$NameP1 = $row['User'];
		
		if($UserID2!=69){
			if($UserID2==$UserID) $Played = ' ';
			elseif($UserID1==$UserID) $Played = ' ';
			else $Played = 'disabled';

			$resultUser2 = mysqli_query($Connect_CG, "SELECT * FROM users WHERE ID='$UserID2'");
			$row = $resultUser2->fetch_assoc();
			$NameP2 = $row['User'];
		}else{
			$NameP2 = $Lang_Wait;
			$Played = ' ';
		}*/
		$ColorDarker = adjustBrightness($Color, -40);

		$List .= '
		<div class="col-lg-12">
			<div class="card h-100 card-curved-lg text-dark" style="background-color: #'.$Color.'">
				<div class="card-body">
					<span class="fa-stack fa-2x">
						<i class="fa fa-circle fa-stack-2x" style="color: #'.$ColorDarker.';"></i>
						<i class="'.$Icon.' fa-stack-1x"></i>
					</span>
					<B>'.$Name.'</B>
				</div>
				<div class="card-footer">
				

					<div class="col-sm-12 text-center">'.$Type.'</div>
				</div>
			</div>
		</div>';
	}
    
	echo $List;
?>