<?php
    require_once("Resources/Config.php");
    function CPM($PPM, $Kactivity){
        $CPM = $PPM + $Kactivity;
        $CPM = round($CPM, 2);
        return $CPM;
    }
    function PAL($PPM, $CPM){
        $PAL = $CPM / $PPM;
        $PAL = round($PAL, 2);
        return $PAL;   
    }
    function activity_kcal($Connect, $Aid, $Time, $UserID){
        $result = mysqli_query($Connect, "SELECT * FROM persona WHERE UserID='$UserID'");
		$row = $result->fetch_assoc();
		$Weight = $row['Weight'];
		$NOW = date("Y-m-d");
		$Kactivity = mysqli_query($Connect, "SELECT SUM(KCAL) FROM useractivity WHERE UserID='$UserID' AND Date LIKE '$NOW' ");
		print_r($Kactivity);
		/*$PPM = $row['PPM'];		
        $result = mysqli_query($Connect, "SELECT * FROM activity_met WHERE ID='$Aid'");
		$row = $result->fetch_assoc();
		$MET = $row['MET'];
		
        $kcal = ($MET/60)*$Weight*$Time;
        $pkt = $kcal *0.1/2;
        $Kactivity += $kcal;
        $CPM = CPM($PPM, $Kactivity);
        $PAL = PAL($PPM, $CPM);
        $Connect->query("UPDATE persona SET SumKCAL='$Kactivity', Score=Score+'$pkt', CPM='$CPM',PAL='$PAL' Where UserID='$UserID'");
        $Connect->query("INSERT INTO user_activity VALUES (NULL, '$UserID', '$Aid', '$Time', '$kcal', now() )");*/
    }
    
    $weight=75;
    $wzrost = 179;
    $Aid = 12;
    $Time = 60;
    $Sex='M';
    $UserID=3;  
    
    activity_kcal($Connect, $Aid, $Time, $UserID);
    
    
    
    
    
    
    //https://kalkulatorkalorii.net/tabela-kalorii/
    
    
    
    
    //https://dietetykpro.pl/kalkulatory/bmc
    
    /*<i class="fas fa-basketball-ball"></i>
    <i class="fas fa-bicycle"></i>
    <i class="fas fa-cat"></i>
    <i class="fas fa-dog"></i>
    */
?>










