<?php
    session_start();
    require_once("../Config.php");
    require_once("../Functions.php");
    
    $HabitsID = $_GET['id'];
    $UserID = $_GET['userid'];
    
    
    $result = mysqli_query($Connect, "SELECT * FROM habitsuser WHERE UserID='$UserID' AND HabitsID='$HabitsID'");
    $count = $result->num_rows;
    if($count<1){
        $Connect->query("INSERT INTO habitsuser VALUES (NULL, '$UserID', '$HabitsID', now())");
        echo 'OK - Add: '.$HabitsID;
    }else{
        echo 'OK - Exist: '.$HabitsID;
    }
?>