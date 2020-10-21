<?php
	session_start();
	include("../Core/Connect.php");
	

	$sth = mysqli_query($Connect, "SELECT * FROM productsuser LIMIT 10");
	while($row=mysqli_fetch_assoc($sth)){
		
		$Name = $row['Name'];
		$ProductID = $row['ProductID'];
		
		$result = mysqli_query($Connect, "SELECT * FROM products WHERE ID = '$ProductID'");
    		$row = $result->fetch_assoc();
    		$NameP = $row['Name'];
    		$K = $row['Kcal'];
    		$P = $row['Proteins'];
    		$C = $row['Carbohydrates'];
    		$F = $row['Fats'];

		$Result .= '
		            
		            <div class="form-group mb-3">
		            <small id="podpowiedz" class="form-text text-muted col-sm-2" style="font-size:10"></small>
		            <small id="podpowiedz" class="form-text text-muted col-sm-2" style="font-size:10">Kcal:</small>
		            <small id="podpowiedz" class="form-text text-muted col-sm-2" style="font-size:10">Proteins:</small>
		            <small id="podpowiedz" class="form-text text-muted col-sm-2" style="font-size:10">Carbohydrates:</small>
		            <small id="podpowiedz" class="form-text text-muted col-sm-2" style="font-size:10">Fats:</small>
		            <small id="podpowiedz" class="form-text text-muted col-sm-2" style="font-size:10">Podaj ilość(g):</small>
		                <div>
		                  
		                    '.$NameP.' '.$K.' '.$P.' '.$C.' '.$F.'
                            <input type="number" class="form-control" id="" placeholder="Ilość" name="" min="0" max="999" value="100">
                        </div>
                    </div>
                    
		            ';
	}
	

	echo $Result;
	
	
?>