<?php
    require_once("Resources/Config.php");
    
    function KCAL($Connect, $Aid, $Time, $UserID){
        $result = mysqli_query($Connect, "SELECT * FROM persona WHERE UserID='$UserID'");
		$row = $result->fetch_assoc();
		$Weight = $row['Weight'];
		
        $result = mysqli_query($Connect, "SELECT * FROM activity_met WHERE ID='$Aid'");
		$row = $result->fetch_assoc();
		$MET = $row['MET'];
		
        $kcal = ($MET/60)*$Weight*$Time;
        $pkt = $kcal *0.1/2;
        
        $Connect->query("UPDATE persona SET SumKcal=SumKcal+'$kcal', Score=Score+'$pkt' Where UserID='$UserID'");
        $Connect->query("INSERT INTO users_activity VALUES (NULL, '$UserID', '$Aid', '$Time',now())");
    }
    
    $weight=75;
    $wzrost = 179;
    $Aid = 12;
    $Time = 60;
    $Sex='M';
    $UserID=3;  
    
    KCAL($Connect, $Aid, $Time, $UserID);
    
    
    
    
    
    
    //https://kalkulatorkalorii.net/tabela-kalorii/
    
    
    
    
    //https://dietetykpro.pl/kalkulatory/bmc
    
    /*<i class="fas fa-basketball-ball"></i>
    <i class="fas fa-bicycle"></i>
    <i class="fas fa-cat"></i>
    <i class="fas fa-dog"></i>
    */
?>










