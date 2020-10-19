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

		if(isset($_POST['Weight'])) CompleteProfil($Connect, $UserID, $_POST['Weight'], $_POST['Height'], $_POST['Sex']);

		$result = mysqli_query($Connect, "SELECT * FROM persona WHERE UserID='$UserID'");
		$count = $result->num_rows;
        if($count>0) $UserOK = true;
        else $UserOK = false;
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
		<link href="CSS/Colors.css" rel="stylesheet">
		<link href="CSS/Main.css" rel="stylesheet">
		
		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        
        <title><?php echo $SB['main_page'].' - '.$Title;?></title>
	</head>
	<body>
		<!-- Navigation -->
		<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-navbar">
			<div class="container">
				<a class="navbar-brand text-dark" href="<?php echo $Link;?>"><IMG src="Graphic/Navbar.png" class="d-inline-block mr-sm-1 align-bottom" width="30" height="30" alt="Menu"> <?php echo $Title;?></a>
			
				<?php
					echo '<a class="text-dark" href="profil.php">
							<span class="fa-stack fa-2x">
								<i class="fa fa-circle fa-stack-2x" style="color: #b4e5c5;"></i>
								<i class="fas fa-user fa-stack-1x"></i>
							</span>
						</a>';
				?>
			</div>
		</nav>

		<!-- <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #FCB9AA !important; margin-bottom: 15px;">
			<div class="container" id="DailyHabits">
				
			</div>
		</nav>-->

		<!-- AddHAbits -->
		<div class="modal fade" id="AddHabits" tabindex="-1" role="dialog" aria-labelledby="AddHabitsLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="AddHabitsLabel"><?php echo $SB['habits_add']?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<?php GetHabbits($Connect, $UserID);?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $SB['close_btn']?></button>
					</div>
				</div>
			</div>
		</div>

		<!-- UpdateWeight -->
		<div class="modal fade" id="UpdateWeight" tabindex="-1" role="dialog" aria-labelledby="UpdateWeightLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="UpdateWeightLabel"><?php echo $SB['weight_update']?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form action="#" method="post" class="form-inline mt-2 mt-md-0"  id="WeightForm" onSubmit="return false;">
							<input class="form-control mr-1 form-100" type="number" name="WeightUpdate" id="WeightUpdate" maxlength="4" placeholder="<?php echo $SB['weight'];?>">
							<button type="submit" class="btn btn-form"><?php echo $SB['complete_profil_btn'];?></button>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $SB['close_btn']?></button>
					</div>
				</div>
			</div>
		</div>

		<!-- UpdateActivity -->
		<div class="modal fade" id="UpdateActivity" tabindex="-1" role="dialog" aria-labelledby="UpdateActivityLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="UpdateActivityLabel"><?php echo $SB['weight_update']?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form action="#" method="post" class="form-inline mt-2 mt-md-0 mb-3"  id="ActivityForm" onSubmit="return false;">
							<label for="hour" class="form-check-label">Godziny</label>
							<input type="number" class="form-control mr-1 form-100" id="hour" placeholder="H" name="h" max="24">
							<label for="min" class="form-check-label">Minuty</label>
							<input type="number" class="form-control mr-1 form-100" id="min" placeholder="MIN" name="min"max="60">

							<span class="text-uppercase pointer font-nav">Aktywności</span>
							<input type="search" class="form-control mr-1 form-100 search" placeholder="Wyszukaj..." autofocus="autofocus"  onkeyup="showResult(this.value)">

							<div id="livesearch"></div>
							<button type="submit" class="btn btn-form">'.$SB['complete_profil_btn'].'</button>
						</form>

						<div id="ActivityFormY"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $SB['close_btn']?></button>
					</div>
				</div>
			</div>
		</div>

		<!-- Page Content -->
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<?php
							if($UserOK){
								echo '<span id="Habits"></span>
								<span class="fa-stack fa-2x" data-toggle="modal" data-target="#AddHabits" style="bottom: 50px; position: sticky;">
									<i class="fa fa-circle fa-stack-2x" style="color: #6e9f7f;"></i>
									<i class="fas fa-plus fa-stack-1x"></i>
								</span>';
							}else{
								echo '<div class="col-sm-12">
									<div class="card card-curved text-dark bg-form">
										<div class="card-block">
											<h3 class="card-title text-center"><i class="fas fa-sign-in-alt"></i>'.$SB['complete_profil'].'</h3>
											<form action="#" method="post" class="form-inline mt-2 mt-md-0">
												<input class="form-control mr-1 form-100" type="number" name="Weight" maxlength="4" placeholder="'.$SB['weight'].'">
												<input class="form-control mr-1 form-100" type="number" name="Height" maxlength="4" placeholder="'.$SB['height'].'">
												<label for="male" class="form-check-label">'.$SB['sex_m'].'</label>
												<input class="mr-1 form-check-input" type="radio" name="Sex" value="M" id="male"><br>
												<label for="female" class="form-check-label">'.$SB['sex_k'].'</label>
												<input class="mr-1 form-check-input" type="radio" name="Sex" value="K" id="female">
												<button type="submit" class="btn btn-form">'.$SB['complete_profil_btn'].'</button>
											</form>
										</div>
									</div>
								</div>';
							}
						?>
					</div>
				</div>
			</div>
		</div>

		<!-- Bootstrap core JavaScript -->
		<script src="Vendor/jquery/jquery.min.js"></script>
		<script src="Vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
			function showResult(str){
				if(str.length==0){
					document.getElementById("livesearch").innerHTML="";
					document.getElementById("livesearch").style.border="0px";
					return;
				}
				
				if(window.XMLHttpRequest){
					xmlhttp=new XMLHttpRequest();
				}else{
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				
				xmlhttp.onreadystatechange=function(){
				if(this.readyState==4 && this.status==200){
					document.getElementById("livesearch").innerHTML=this.responseText;
					//document.getElementById("livesearch").style.border="1px solid #28a745";
					//document.getElementById("livesearch").style.marginTop="3px";
				}
			  }
				xmlhttp.open("GET","Resources/Ajax/LiveSearch.php?q="+str,true);
				xmlhttp.send();
			}

            function AddHabit(id, userid){
                $(document).ready(function(){
                    $.get('Resources/Ajax/AddHabit.php', {id: id, userid: userid}, function(data){
                        //$("#UserInfo").html(data);
						console.log(data);
                    });
                });
			}

			function UpdateHabit(HabitsID, UserID){
                $(document).ready(function(){
                    $.get('Resources/Ajax/UpdateHabit.php', {HabitsID: HabitsID, UserID: UserID}, function(data){
						console.log(data);
                    });
                });
			}
        
            $(document).ready(function(){
				$(document).on('submit', '#WeightForm', function(){
                    var Weight = $.trim($("#WeightUpdate").val());
					var UserID = '<?php echo $UserID;?>';
					
                    if(Weight != ""){
                        $.get('Resources/Ajax/WeightUpdate.php', {Weight: Weight, UserID: UserID}, function(data){
							$("#WeightForm").html(data);
                        });
                    }else{
                        alert("Complete all fields!");
                    }
                });

				$(document).on('submit', '#ActivityForm', function(){
                    var Hour = $.trim($("#hour").val());
					var Min = $.trim($("#min").val());
					var Activity = $.trim($("#Activity").val());
					var UserID = '<?php echo $UserID;?>';
					
                    if(Hour != ""){
                        $.get('Resources/Ajax/ActivityUpdate.php', {Hour: Hour, Min: Min, Activity: Activity, UserID: UserID}, function(data){
							$("#ActivityFormY").html(data);
                        });
                    }else{
                        alert("Complete all fields!");
                    }
                });

				//Get Habits
                function GetHabits(){
                    $.get('Resources/Ajax/GetHabits.php', function(data){
                        $("#Habits").html(data);
                    });
                }
				

				GetHabits();
                setInterval(function(){
					GetHabits();
                },1000);
            });
        </script>
	</body>
</html>
