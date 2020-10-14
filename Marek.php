<?php
    function Update($Col, $Value){
        echo 'Update';
    }
    function min_watter($weight){
        $min_watter = 30*$weight;
        Update('Min_Watter', $min_watter);
        //echo $min_watter;
    }
    function BMI($weight, $wzrost){
        $BMI = $weight/pow(($wzrost/100),2);
        if($BMI<18.5)$pkt=0.5;
        else if($BMI>=18.5 && $BMI<=24.9)$pkt=10;
        else if($BMI>24.9 && $BMI<=29.9)$pkt=1;
        else if($BMI>29.9 && $BMI<=39.9)$pkt=0.5;
        else $pkt=0.1 ;
        
        return $pkt;
        
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
    function LBM($weight, $wzrost, $Sex){
        if($Sex == 'K'){
            $LBM = 1.07 * $weight - 148*pow(($weight/$wzrost),2);
        }else{
            $LBM = 1.1 * $weight - 128*pow(($weight/$wzrost),2);
        }
        Update('LBM', $LBM);
        return $LBM;
    }
    function PPM($LBM){
        $PPM = 500 + (22*$LBM);
        Update('PPM', $PPM);
        return $PPM;
    }
    function CPM($PPM){
        $Kactivity  = 500;
        $CPM = $PPM + $Kactivity;
        Update('CPM', $CPM);
        return $CPM;
    }
    function PAL($PPM, $CPM){
        $PAL = $CPM / $PPM;
        Update('PAL', $PAL);
        echo $PAL;   
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










