<?php
	session_start();
	include("../Core/Connect.php");
	
	
	$Querry = $_GET['q'];


	$sth = mysqli_query($Connect, "SELECT * FROM products WHERE Name Like '$Querry%' LIMIT 10");
	while($row=mysqli_fetch_assoc($sth)){
		
		$Name = $row['Name'];
		$ProductID = $row['ID'];

		$Result .= '
		            <button type="button" class="btn btn-secondary" onclick="sendproducts('.$ProductID.')">'.$Name.'</button><br>
		            
		            <!--
		            <div class="form-group mb-3">
		            <small id="podpowiedz" class="form-text text-muted col-sm-2" style="font-size:10">Podaj ilość:</small>
		                <div class="row">
                            <input type="number" class="form-control" id="" placeholder="Ilość" name="" min="0" max="99" value="1">
                            <button type="submit" class="btn btn-secondary"">Dodaj</button>
                        </div>
                    </div>
                    -->
		            ';
	}
	
	if($Result=="") echo '<input type="button" class="dropdown-item" type="button" value="Nie znaleziono takiego produktu"/>';
	else echo $Result;
	
	
?>
