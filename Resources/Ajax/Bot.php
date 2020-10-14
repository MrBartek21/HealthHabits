<?php
    session_start();
    require_once("../Config.php");
    $id=$_GET['id'];

    //$result = mysqli_query($Connect, "SELECT * FROM products WHERE ID='$id'");
    $result = mysqli_query($Connect, "SELECT * FROM products WHERE `Kcal` = '0' AND `Proteins` = '0' AND `Carbohydrates` = '0' AND `Fats` = '0'");
	while($row=mysqli_fetch_array($result)){
		$ID = $row['ID'];
        $Type = $row['Test'];

        echo $ID."  ";

        if($Type==""){
            echo "0";
        }else{
            $Type = explode(", ", $Type);
            
            print_r($Type);

            $kcal = $Type[1];
            $prot = str_replace(",",".",$Type[2],$i);
            $carb = str_replace(",",".",$Type[3],$i);
            $fats = str_replace(",",".",$Type[4],$i);

            $Connect->query("UPDATE products SET Kcal='$kcal' WHERE ID='$ID'");
            $Connect->query("UPDATE products SET Proteins='$prot' WHERE ID='$ID'");
            $Connect->query("UPDATE products SET Carbohydrates='$carb' WHERE ID='$ID'");
            $Connect->query("UPDATE products SET Fats='$fats' WHERE ID='$ID'");

        }
        
        echo "<br>";
	}
?>