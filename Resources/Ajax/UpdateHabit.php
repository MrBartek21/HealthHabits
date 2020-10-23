<?php
    session_start();
    require_once("../Config.php");
    require_once("../Functions.php");
    require_once("../Subtitles.php");
    
    $HabitsID = $_GET['HabitsID'];
    $UserID = $_GET['UserID'];


    $Connect->query("INSERT INTO historyhabits VALUES (NULL, '$UserID', '$HabitsID', now())");
    $Connect->query("UPDATE persona SET Score=Score+5 WHERE UserID='$UserID'");
    echo $SB['habits_updated_m'];

    /*$result = mysqli_query($Connect, "SELECT * FROM persona WHERE UserID='$UserID'");
	$row = $result->fetch_assoc();
    $Sex = $row['Sex'];	

    if($Sex=='K') echo '<div class="alert alert-success text-center" role="alert">'.$SB['habits_updated_k'].'</div>';
    else echo '<div class="alert alert-success text-center" role="alert">'.$SB['habits_updated_m'].'</div>';*/
?>