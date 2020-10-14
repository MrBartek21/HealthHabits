<?php
	session_start();
	include("../Core/Connect.php");
	
	
	$Querry = $_GET['q'];

    function dodaj(){
        //$Connect->query("INSERT INTO game VALUES (NULL, '$Code', now(), '0', '5', '10', '$QuestionID')");
        echo 'codfsdgdf';
        
    }
	$sth = mysqli_query($Connect_HH, "SELECT * FROM activity_met WHERE Name Like '$Querry%' ");
	while($row=mysqli_fetch_assoc($sth)){
		
		$Name = $row['Name'];

		$Result .= '<a class="dropdown-item">'.$Name.'</a><br>
		            
		            <div class="form-group mb-3">
		            <small id="podpowiedz" class="form-text text-muted col-sm-2" style="font-size:10">Podaj czas:</small>
		                <div class="row">
                            <input type="number" class="form-control" id="" placeholder="H" name="h" min="0" max="24">
                            <input type="number" class="form-control" id="" placeholder="MIN" name="min" min="0" max="60">
                            <button type="submit" class="btn btn-secondary" onclick="dodaj()">Dodaj</button>
                        </div>
                    </div>
		            ';
	}
	
	if($Result=="") echo '<input type="button" class="dropdown-item" type="button" value="Nie znaleziono takiej aktywności"/>';
	else echo $Result;
	
	
?>
