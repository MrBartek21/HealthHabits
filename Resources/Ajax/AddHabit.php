<?php
    session_start();
    require_once("../Config.php");
    require_once("../Functions.php");
    
    
    
    $HabitsID = $_GET['id'];
    $UserID = $_GET['userid'];
    
    print_r($_GET);
    
    $result = mysqli_query($Connect, "SELECT * FROM userhabits WHERE UserID='$UserID' AND HabitsID='$HabitsID'");
    $count = $result->num_rows;
    
    echo $count;
    if($count<1){
        $Connect->query("INSERT INTO userhabits VALUES (NULL, '$UserID', '$HabitsID', now(), now())");
        echo 'OK - Add: '.$HabitsID;
    }else{
        echo 'OK - Exist: '.$HabitsID;
    }
?>