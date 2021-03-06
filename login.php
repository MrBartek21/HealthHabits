<?php
    session_start();
	
	require_once("Resources/Config.php");
	require_once("Resources/Functions.php");
	require_once("Resources/Subtitles.php");

    define('SESSION_COOKIE',$Title2);
    define('SESSION_ID_LENGHT',40);
    define('SESSION_COOKIE_EXPIRE',43200);
	
	
	if(isset($_SESSION['HH_Logged'])) header('Location: index.php');
	if(isset($_POST['UserName'])) login($Connect, $_POST['UserName'], $_POST['UserPass']);
	if(isset($_POST['RUserEmail'])) register($Connect, $_POST['RUserName'], $_POST['RUserEmail'], $_POST['RUserPass'], $_POST['RUserPass2']);
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
        
        <title><?php echo $SB['login_page'].' - '.$Title;?></title>
	</head>
	<body style="padding-top: 90px;">
		<!-- Navigation -->
		<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-navbar">
			<div class="container">
				<a class="navbar-brand text-dark" href="<?php echo $Link;?>"><IMG src="Graphic/Navbar.png" class="d-inline-block mr-sm-1 align-bottom" width="40" height="40" alt="Menu"> <?php echo $Title;?></a>
			</div>
		</nav>

		<!-- Page Content -->
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
                        <?php if(isset($_SESSION['error'])) echo $_SESSION['error'];?>
                        
						<div class="col-lg-12">
							<div class="card card-curved text-dark bg-form">
								<div class="card-block">
									<h3 class="card-title text-center"><i class="fas fa-sign-in-alt"></i> <?php echo $SB['log_in'];?></h3>
									<form action="#" method="post" class="form-inline mt-2 mt-md-0">
								    	<input class="form-control mr-1 form-100" type="text" name="UserName" placeholder="<?php echo $SB['login'];?>">
										<input class="form-control mr-1 form-100" type="password" name="UserPass" placeholder="<?php echo $SB['password'];?>">
										<button type="submit" class="btn btn-form"><?php echo $SB['log_in_btn'];?></button>
									</form>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12">
							<div class="card card-curved text-dark bg-form">
								<div class="card-block">
									<h3 class="card-title text-center"><i class="fas fa-sign-in-alt"></i> <?php echo $SB['signing_in'];?></h3>
									<form action="#" method="post" class="form-inline mt-2 mt-md-0">
										<input class="form-control mr-1 form-100" type="text" name="RUserName" maxlength="20" placeholder="<?php echo $SB['login'];?>">
										<input class="form-control mr-1 form-100" type="text" name="RUserEmail" placeholder="<?php echo $SB['email'];?>">
										<input class="form-control mr-1 form-100" type="password" name="RUserPass" placeholder="<?php echo $SB['password'];?>">
										<input class="form-control mr-1 form-100" type="password" name="RUserPass2" placeholder="<?php echo $SB['repeat_password'];?>">
										<button type="submit" class="btn btn-form"><?php echo $SB['signing_in_btn'];?></button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Bootstrap core JavaScript -->
		<script src="Vendor/jquery/jquery.min.js"></script>
		<script src="Vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	</body>
</html>
