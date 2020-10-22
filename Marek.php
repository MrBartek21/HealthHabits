<?php
    $tab = ['a','b','c','d','e','f','g'];
    $x=97;
    for($i=0; $i<count($tab); $i++){
        $tasocName["$tab[$i]"] = $x;
        $x++;
    }
    while( list($klucz, $wartosc) = each( $tasocName) ){
        echo "$klucz => $wartosc<BR>";
    }
    
    
    
    
    //https://kalkulatorkalorii.net/tabela-kalorii/
    
    
    
    
    //https://dietetykpro.pl/kalkulatory/bmc
    
    /*<i class="fas fa-basketball-ball"></i>
    <i class="fas fa-bicycle"></i>
    <i class="fas fa-cat"></i>
    <i class="fas fa-dog"></i>
    */
?>










