<?php
    session_start();
	require_once("../Config.php");
	require_once("../Functions.php");
	require_once("../Subtitles.php");

	$UserID = $_SESSION['HH_ID'];

	$result = mysqli_query($Connect, "SELECT * FROM userhabits WHERE UserID='$UserID'");
	$count = $result->num_rows;
    if($count>0){
		$result = mysqli_query($Connect, "SELECT * FROM userhabits WHERE UserID='$UserID'");
		while($row=mysqli_fetch_array($result)){
			$Name = $row['Name'];
			$Type = $row['Type'];
			$Color = $row['Color'];
			$Icon = $row['Icon'];
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
	}else{
		echo '<div class="alert alert-warning text-center" role="alert">'.$SB['zero_habbits'].'</div>';
	}
?>