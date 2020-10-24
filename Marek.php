<?php
    function size_plant(){
        $lvl=0;//z persony
        if($lvl <10 )echo"nasionko";
        elseif($lvl>=10 && $lvl <25)echo "mała";
        else echo 'duża';
    }
    function dry_plant(){
        
        $water=0 //suma wypitej wody w danym dniu
        $min_water=1800 //z persony
        if($water<$min_water/2)echo 'sucho';
        else echo 'normalne';
        
    }
    function Plant_level(){
        //wykonywać co każde dodawanie pkt
        $score=0;//z persony
        $lvl = intval($score/25);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    //https://kalkulatorkalorii.net/tabela-kalorii/
    
    
    
    
    //https://dietetykpro.pl/kalkulatory/bmc
    
    /*<i class="fas fa-basketball-ball"></i>
    <i class="fas fa-bicycle"></i>
    <i class="fas fa-cat"></i>
    <i class="fas fa-dog"></i>
    */
?>










