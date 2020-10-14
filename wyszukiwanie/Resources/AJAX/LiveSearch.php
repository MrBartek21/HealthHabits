<?php
	session_start();
	include("../Core/Connect.php");
	
	$Querry = $_GET['q'];
	$Querry = strtolower($Querry);
	$Querry = explode(" ", $Querry);
	$QuerryName = $Querry[0];
	$QuerrySurname = $Querry[1];
	
	$i = 1;
	
	$sth = mysqli_query($connect, "SELECT * FROM players WHERE Name Like '$QuerryName%' AND Surname Like '$QuerrySurname%' AND Type=0");
	while($row=mysqli_fetch_assoc($sth)){
		$UserID = $row['ID'];
		
		$UserName = $row['Name'];
		$UserSurname = $row['Surname'];
		$UserClub = $row['Club'];
		
		if($i%2==0) $color = 'muted';
		else $color = 'light';
		
		$Name = $UserName.' '.$UserSurname;
		
		$NameTemp = $UserName.$UserSurname;
		$QuerryTemp = $QuerryName.$QuerrySurname;
		
		$NameTemp = strtolower($NameTemp);
		$QuerryTemp = strtolower($QuerryTemp);
		
		if(strpos($NameTemp, $QuerryTemp) !== false){
			$NameLen = strlen($Name);
			$QuerryTempLen = strlen($QuerryTemp);
			
			$WordB = substr($Name,0,$QuerryTempLen);
			$Words = substr($Name, $QuerryTempLen,$NameLen);
			
			$Name = '<B>'.$WordB.'</B>'.$Words;
		}
		
		$Result .= '<a href="view.php?Name='.$UserName.'&ID='.$UserID.'" class="dropdown-item font-livesearch bg-'.$color.'">'.$Name.' - '.$UserClub.'</a>';
		
		$i++;
	}
	
	if($Result=="") echo '<input type="button" class="dropdown-item bg-light" type="button" value="Nie znaleziono takiego zawodnika"/>';
	else echo $Result;
?>