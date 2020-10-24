<?php
    session_start();
	
	require_once("Resources/Config.php");
	require_once("Resources/Functions.php");
	require_once("Resources/Subtitles.php");

    define('SESSION_COOKIE',$Title2);
    define('SESSION_ID_LENGHT',40);
	define('SESSION_COOKIE_EXPIRE',43200);
	
	if(isset($_SESSION['HH_Logged'])){
		$UserID = $_SESSION['HH_ID'];
        $UserName = $_SESSION['HH_User'];

        $Plant = SizePlant($Connect, $UserID);
        $Water = DryPlant($Connect, $UserID, $WaterID);

        $Src = $Plant.$Water.'1.png';
	}else{
		header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<link rel="apple-touch-icon" sizes="57x57" href="Graphic/Favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="Graphic/Favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="Graphic/Favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="Graphic/Favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="Graphic/Favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="Graphic/Favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="Graphic/Favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="Graphic/Favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="Graphic/Favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="Graphic/Favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="Graphic/Favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="Graphic/Favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="Graphic/Favicon/favicon-16x16.png">
		
		<meta name="robots" content="index, follow">
		<meta name="msapplication-TileImage" content="Graphic/Favicon/ms-icon-144x144.png"/>
		<meta name="msapplication-TileColor" content="#<?php echo $Color;?>"/>
		<meta name="theme-color" content="#<?php echo $Color;?>"/>
        <link rel="manifest" href="Graphic/Favicon/manifest.json">
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="author" content="<?php echo $Author;?>"/>
        <meta name="keywords" content="<?php echo $Keywords;?>" />
        <meta name="description" content="<?php echo $Description;?>"/>
		
		<!-- Bootstrap core CSS -->
		<link href="Vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Custom styles -->
		<link href="CSS/Main.css" rel="stylesheet">
		
		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        
        <title><?php echo $SB['game_page'].' - '.$Title;?></title>
	</head>
	<body style="padding: 0px;">
		<!-- Page Content -->
        <div class="container text-center" style="padding: 0px;">
            <img src="Graphic/Game/Background.gif" class="img-fluid" style=" position: absolute;">
            <img src="Graphic/Game/<?php echo $Src;?>" class="img-fluid" style=" position: relative;">
        </div>
        
        <!-- Footer -->
		<footer class="py-2 bg-footer text-dark fixed-bottom text-center">
			<div class="container">
				<div class="row">
					<div class="col-4">
						<a href="profil.php"><span class="fa-stack fa-2x">
							<i class="far fa-circle fa-stack-2x"></i>
							<i class="fas fa-user fa-stack-1x"></i>
						</span></a>
					</div>
					<div class="col-4">
						<a href="index.php"><span class="fa-stack fa-2x">
							<i class="far fa-circle fa-stack-2x"></i>
							<i class="fas fa-plus fa-stack-1x"></i>
						</span></a>
					</div>
					<div class="col-4">
						<a href="game.php"><span class="fa-stack fa-2x">
							<i class="far fa-circle fa-stack-2x"></i>
							<i class="fas fa-seedling fa-stack-1x"></i>
						</span></a>
					</div>
				</div>
			</div>
		</footer>

		<!-- Bootstrap core JavaScript -->
		<script src="Vendor/jquery/jquery.min.js"></script>
		<script src="Vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	</body>
</html>
