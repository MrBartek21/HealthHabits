<?php
    function Update($Col, $Value){
        echo 'Update';
    }
    
    
    function KCAL($Aid, $Time, $weight){
        require_once("Resources/Config.php");
        $result = mysqli_query($Connect, "SELECT * FROM activity_met WHERE ID='$Aid'");
		$row = $result->fetch_assoc();
		$MET = $row['MET'];
        $kcal = ($MET/60)*$weight*$Time;
        echo $row['Name'];
        echo $kcal;
    }
    
    $weight=75;
    $wzrost = 179;
    $Aid = 23;
    $Time = 600;
    $Sex='M';
    
    min_watter($weight);
    $pkt = BMI($weight, $wzrost);
    echo $pkt;
    echo '<br />';
    KCAL($Aid, $Time, $weight);
    echo '<br />';
    $LBM = LBM($weight, $wzrost, $Sex);
    $PPM = PPM($LBM);
    $CPM = CPM($PPM);
    PAL($PPM, $CPM);
    
    
    
    
    
    //https://kalkulatorkalorii.net/tabela-kalorii/
    
    
    
    
    //https://dietetykpro.pl/kalkulatory/bmc
    
    /*<i class="fas fa-basketball-ball"></i>
    <i class="fas fa-bicycle"></i>
    <i class="fas fa-cat"></i>
    <i class="fas fa-dog"></i>
    */
?>










