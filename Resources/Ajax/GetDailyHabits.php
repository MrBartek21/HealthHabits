<?php
    session_start();
	require_once("../Config.php");
	require_once("../Functions.php");

    $result = mysqli_query($Connect, "SELECT * FROM habits WHERE Type=1");
	while($row=mysqli_fetch_array($result)){
		$Name = $row['Name'];
		$Type = $row['Type'];
		$Color = $row['Color'];
		$Icon = $row['Icon'];
		
		$ColorDarker = adjustBrightness($Color, -40);

		$List .= '
		<div class="col-lg-12">
			<div class="card text-dark" style="background-color: #'.$Color.';">
				<div class="card-body">
					<span class="fa-stack fa-2x">
						<i class="fa fa-circle fa-stack-2x" style="color: #'.$ColorDarker.';"></i>
						<i class="'.$Icon.' fa-stack-1x"></i>
					</span>
					<B>'.$Name.'</B>
				</div>
			</div>
		</div>';
	}
    
	echo $List;
?>