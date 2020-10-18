<?php
    session_start();
    require_once("../Config.php");
    require_once("../Functions.php");
    require_once("../Subtitles.php");
    
    $Weight = $_GET['Weight'];
    $UserID = $_GET['UserID'];
    
    $result = mysqli_query($Connect, "SELECT * FROM habits WHERE Name='Waga'");
    $row = $result->fetch_assoc();
    $HabitsID = $row['ID'];


    $Connect->query("UPDATE userhabits SET UpdateTime=now() WHERE UserID='$UserID' AND HabitsID='$HabitsID'");

    $result = mysqli_query($Connect, "SELECT * FROM persona WHERE UserID='$UserID'");
    $row = $result->fetch_assoc();
    $Height = $row['Height'];
    $Sex = $row['Sex'];
    $Kactivity = $row['SumKCAL'];
    
    $BMI2 = BMI($Weight, $Height);
    $BMI = $BMI2[0];
    $pkt = $BMI2[1];
    $MinWater = MinWater($Weight);
    $LBM = LBM($Weight, $Height, $Sex);
    $PPM = PPM($LBM);
    $CPM = CPM($PPM, $Kactivity);
    $PAL = PAL($PPM, $CPM);
    

    $Connect->query("UPDATE persona SET Score=Score+'$pkt' WHERE UserID='$UserID'");
    $Connect->query("UPDATE persona SET Weight='$Weight' WHERE UserID='$UserID'");
    $Connect->query("UPDATE persona SET Height='$Height' WHERE UserID='$UserID'");
    $Connect->query("UPDATE persona SET Min_water='$MinWater' WHERE UserID='$UserID'");
    $Connect->query("UPDATE persona SET BMI='$BMI' WHERE UserID='$UserID'");
    $Connect->query("UPDATE persona SET LBM='$LBM' WHERE UserID='$UserID'");
    $Connect->query("UPDATE persona SET PPM='$PPM' WHERE UserID='$UserID'");
    $Connect->query("UPDATE persona SET CPM='$CPM' WHERE UserID='$UserID'");
    $Connect->query("UPDATE persona SET PAL='$PAL' WHERE UserID='$UserID'");

    $Connect->query("INSERT INTO userhistory VALUES (NULL, '$UserID', '$Weight', '$Height', '$MinWater', '$BMI', '$LBM', '$PPM', '$CPM', now())");
    


    echo 'OK - Add: '.$HabitsID;
?>