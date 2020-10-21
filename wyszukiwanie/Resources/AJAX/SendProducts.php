<?php
    session_start();
    include("../Core/Connect.php");
	

	$ProductsID = $_GET['ProductsID'];

	
    $sql = "INSERT INTO productsuser VALUES (NULL, '0', 1, '$ProductsID')";
	$Connect->query($sql);
	

?>