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

        $file = $UserID.'.png';
		$src = 'Graphic/Avatars/';
		if(file_exists($src.'/'.$file)){
			$UserAvatar = $src.'/'.$UserID.'.png';
		}else{
			$UserAvatar = $src.'/0.png';
		}
        
        //User Info
		$result = mysqli_query($Connect, "SELECT * FROM users WHERE ID='$UserID'");
		$row = $result->fetch_assoc();
        $UserName = $row['Login'];
        $UserEmail = $row['Email'];
		$UserIP = $row['IP'];
        $UserLastLogin = $row['LastLogin'];
        
        //Persona Info
		$result = mysqli_query($Connect, "SELECT * FROM persona WHERE UserID='$UserID'");
		$row = $result->fetch_assoc();
		$Weight = $row['Weight'];
        $Height = $row['Height'];
        
        $result = mysqli_query($Connect, "SELECT * FROM historypersona WHERE UserID='$UserID' LIMIT 10");
		while($row=mysqli_fetch_array($result)){
            $Weight = $row['Weight'];
            $Date = $row['Date'];
            $WeightTable .= "['$Date', $Weight],";
        }
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
        
        <title><?php echo $SB['profil_page'].' - '.$Title;?></title>

        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart(){
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Topping');
                data.addColumn('number', 'kg');
                data.addRows([<?php echo $WeightTable;?>]);

                var options = {
                    pointsVisible: true,
                    backgroundColor: {fill:'transparent'},
                    legend: 'none',
                    series: {0: {color: '#e2431e'}}
                    };

                var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        </script>
	</head>
	<body>
		<!-- Navigation -->
		<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-navbar">
			<div class="container">
				<a class="navbar-brand text-dark" href="<?php echo $Link;?>"><IMG src="Graphic/Navbar.png" class="d-inline-block mr-sm-1 align-bottom" width="30" height="30" alt="Menu"> <?php echo $Title;?></a>
			
				<?php
					echo '<a class="text-dark" href="profil.php">
							<span class="fa-stack fa-2x">
								<i class="fa fa-circle fa-stack-2x" style="color: #da9788;"></i>
								<i class="fas fa-user fa-stack-1x"></i>
							</span>
						</a>';
				?>
			</div>
		</nav>

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

		<!-- Page Content -->
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">

                        <div class="col-sm-12" style="margin-bottom: 30px;">
                            <div class="card card-curved-lg text-dark p-4" style="box-shadow: 0px 0px 20px 20px #ffffff82; border: none !important; background-color: #ffffff82 !important;">
                                <div class="row">
                                    <div class="col-5"></div>
                                    <div class="col-2"><img class="card-img-top img-fluid rounded-circle" src="<?php echo $UserAvatar; ?>" alt="<?php echo $UserName; ?>"></div>
                                    <div class="col-5"></div>
                                </div>

                                <div class="card-block">
                                    <p class="card-text"><?php echo '<h3 class="text-center"><B>'.$UserName.'</B></h3>'; ?></p>
                                    <p class="card-text text-center"><?php echo '<B>'.$UserEmail.'</B>'; ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12" style="margin-bottom: 20px;">
                            <div class="card-block">
                                <p class="card-text"><?php echo 'Waga: <B>'.$Weight.' kg</B>'; ?></p>
                                <p class="card-text"><?php echo 'Wzrost: <B>'.$Height.' cm</B>'; ?></p>
                            </div>
                        </div>

                        <div class="col-sm-12" style="margin-bottom: 50px;">
                            <h4 class="card-title text-center"><B>Zmiana wagi:</B></h4>
                            <div id="chart_div"></div>
                        </div>

                        <div class="col-sm-12">
                            <div class="card card-curved-lg text-dark p-4" style="box-shadow: 0px 0px 20px 20px #ffffff82; border: none !important; background-color: #ffffff82 !important;">
                                <div class="card-block">
                                    <h4 class="card-title text-center">Poziom wytrwalosci</h4>
                                    <p class="card-text"><?php echo 'Wzrost: <B>'.$Weight.'</B>'; ?></p>
                                    <p class="card-text"><?php echo 'Waga: <B>'.$Height.'</B>'; ?></p>
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

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $(window).resize(function(){
                    drawChart();
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
