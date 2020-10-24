<?php
	session_start();
    require_once("../Config.php");
    require_once("../Functions.php");
    require_once("../Subtitles.php");
	
	
    $Querry = $_GET['q'];

	$sth = mysqli_query($Connect, "SELECT * FROM activitymet WHERE Name Like '%$Querry%'");
	while($row=mysqli_fetch_assoc($sth)){
        $Name = $row['Name'];
        $ID = $row['ID'];

		$Result .= '<label for="Activity" class="form-check-label">'.$Name.'</label>
        <input class="mr-1 form-check-input" type="radio" name="Activity" value="'.$ID.'" id="Activity">
        <input type="hidden" name="HabitsID" value="'.$ActivityID.'" id="HabitsID"><br />';
	}
	
	if($Result=="") echo '<span class="text-center" style="padding: 5px;">'.$SB['not_found'].'</span>';
	else echo $Result;
?>