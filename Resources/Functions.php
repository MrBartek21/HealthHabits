<?php
    function BMI($Weight, $Height){
        $BMI = $Weight/pow(($Height/100), 2);
        if($BMI<18.5) $pkt=0.5;
        else if($BMI>=18.5 && $BMI<=24.9) $pkt=10;
        else if($BMI>24.9 && $BMI<=29.9) $pkt=1;
        else if($BMI>29.9 && $BMI<=39.9) $pkt=0.5;
        else $pkt=0.1;
        $BMI = round($BMI, 2);
        return array($BMI,$pkt);
    }

    function MinWater($Weight){
        $MinWater = 30*$Weight;
        $MinWater = round($MinWater, 2);
        return $MinWater;
    }
    
    function LBM($Weight, $Height, $Sex){
        if($Sex == 'K') $LBM = 1.07 * $Weight - 148*pow($Weight/$Height, 2);
        else $LBM = 1.1 * $Weight - 128*pow($Weight/$Height, 2);
        $LBM = round($LBM, 2);
        return $LBM;
    }
    
    function PPM($LBM){
        $PPM = 500 + (22*$LBM);
        $PPM = round($PPM, 2);
        return $PPM;
    }
    
    function CPM($PPM, $Kactivity){
        $CPM = $PPM + $Kactivity;
        $CPM = round($CPM, 2);
        return $CPM;
    }
    
    function PAL($PPM, $CPM){
        $PAL = $CPM / $PPM;
        $PAL = round($PAL, 2);
        return $PAL;   
    }

    function login($Connect, $Login, $Pass){
        mysqli_report(MYSQLI_REPORT_STRICT);
        include("Resources/Subtitles.php");
		
		try{
			if($Connect->connect_errno!=0){
				throw new Exception(mysqli_connect_errno());
			}else{
				$Login = htmlentities($Login, ENT_QUOTES, "UTF-8");
			
				if ($result = $Connect->query(sprintf("SELECT * FROM users WHERE Login='%s'", mysqli_real_escape_string($Connect,$Login)))){
					$count = $result->num_rows;
					if($count>0){
						$row = $result->fetch_assoc();
						if(password_verify($Pass, $row['Pass'])){
							$_SESSION['HH_Logged'] = true;
							$_SESSION['HH_ID'] = $row['ID'];
							$_SESSION['HH_User'] = $row['Login'];
							
							$ID = $row['ID'];
							$IP = $_SERVER["REMOTE_ADDR"];
							
							$Connect->query("UPDATE users SET LastLogin = now() WHERE ID = '$ID'");
							$Connect->query("UPDATE users SET IP = '$IP' WHERE ID = '$ID'");
							
							unset($_SESSION['error']);
							$result->free_result();
							
							header('Location: index.php');
						}else{
							$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$SB['wrong_password'].'</div>';
							header('Location: login.php');
						}
					}else{
						$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$SB['wrong_login'].'</div>';
						header('Location: login.php');
					}
				}else{
					throw new Exception($Connect->error);
				}
				$Connect->close();
			}
		}catch(Exception $e){
			$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$SB['error1'].'</div>';
			$_SESSION['error'] .= '<div class="alert alert-danger text-center" role="alert">'.$SB['error2'].' '.$e.'</div>';
		}
	}
	
	function register($Connect, $Login, $Email, $Pass1, $Pass2){
		mysqli_report(MYSQLI_REPORT_STRICT);
		include("Resources/Subtitles.php");
		include("Resources/Config.php");
		
		
		$OK = true;
        //Sprawdzenie długości nicka
        if((strlen($Login)<3) || (strlen($Login)>20)){
            $OK = false;
			$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$SB['wrong_login_len'].'</div>';
        }
        
        if(ctype_alnum($Login)==false){
            $OK = false;
			$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$SB['wrong_login_format'].'</div>';
        }
        
        // Sprawdź poprawność adresu email
        $Email2 = filter_var($Email, FILTER_SANITIZE_EMAIL);
        
        if((filter_var($Email2, FILTER_VALIDATE_EMAIL)==false) || ($Email2!=$Email)){
            $OK = false;
			$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$SB['wrong_email'].'</div>';
        }
        
        //Sprawdź poprawność hasła
        if((strlen($Pass1)<8) || (strlen($Pass1)>20)){
            $OK = false;
			$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$SB['wrong_password_len'].'</div>';
        }
        
        if($Pass1!=$Pass2){
            $OK = false;
			$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$SB['wrong_password_repeat'].'</div>';
        }
        
        $Pass_Hash = password_hash($Pass1, PASSWORD_DEFAULT);
        try{
            if($Connect->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }else{
                //Czy email już istnieje?
                $result = $Connect->query("SELECT ID FROM users WHERE Email='$Email'");
                
                if(!$result) throw new Exception($Connect->error);
                
                $count = $result->num_rows;
                if($count>0){
                    $OK = false;
					$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$SB['email_exist'].'</div>';
                }
                
                //Czy login jest już zarezerwowany?
                $result = $Connect->query("SELECT ID FROM users WHERE Login='$Login'");
                
                if (!$result) throw new Exception($Connect->error);

                $count = $result->num_rows;
                if($count>0){
                    $OK = false;
					$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$SB['login_exist'].'</div>';
                }
                
                if($OK==true){
                    $IP = $_SERVER['REMOTE_ADDR'];
                    
                    if($Connect->query("INSERT INTO users VALUES (NULL, '$Login', '$Pass_Hash', '$Email', '$IP', now(), 0)")){
						$_SESSION['error'] = '<div class="alert alert-success text-center" role="alert">'.$SB['success_register'].'</div>';
                        $_SESSION['Registered'] = true;
                        header('Location: index.php');
                    }else{
                        throw new Exception($Connect->error);
                    }
                }
                $Connect->close();
            }
        }catch(Exception $e){
            $_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$SB['error1'].'</div>';
			$_SESSION['error'] .= '<div class="alert alert-danger text-center" role="alert">'.$SB['error2'].' '.$e.'</div>';
        }
    }
    
    function CompleteProfil($Connect, $UserID, $Weight, $Height, $Sex){
        if(!empty($Sex) && !empty($Weight) && !empty($Height)){
            $Kactivity = 0.0;
    
            $BMI2 = BMI($Weight, $Height);
            $BMI = $BMI2[0];
            $pkt = $BMI2[1];
            $MinWater = MinWater($Weight);
            $LBM = LBM($Weight, $Height, $Sex);
            $PPM = PPM($LBM);
            $CPM = CPM($PPM, $Kactivity);
            $PAL = PAL($PPM, $CPM);
    
            $result = mysqli_query($Connect, "SELECT * FROM users WHERE ID='$UserID'");
            $row = $result->fetch_assoc();
            $Completed = $row['Completed'];
        
            if($Completed==0){
                $Connect->query("INSERT INTO persona VALUES (NULL, '$UserID', '$pkt', 0, '$Weight', '$Height', '$MinWater', '$BMI', '$LBM', '$PPM', '$CPM', '$PAL', '$Sex', '$Kactivity')");
                $Connect->query("INSERT INTO historypersona VALUES (NULL, '$UserID', '$Weight', '$Height', '$MinWater', '$BMI', '$LBM', '$PPM', '$CPM', now())");
                $Connect->query("UPDATE users SET Completed=1 WHERE ID='$UserID'");
            }
        }else echo '<div class="alert alert-danger">'.$SB['empty_form'].'</div>';
    }

    function GetHabbits($Connect, $UserID){
        $result = mysqli_query($Connect, "SELECT * FROM habits");
		while($row=mysqli_fetch_array($result)){
			$ID = $row['ID'];
			$Name = $row['Name'];
			$Type = $row['Type'];
			$Color = $row['Color'];
			$Icon = $row['Icon'];

            $List .= '
                <div class="row">
                    <div class="col-2">
                        <span class="fa-stack fa-2x">
                            <i class="fa fa-circle fa-stack-2x" style="color: #'.$Color.';"></i>
                            <i class="'.$Icon.' fa-stack-1x"></i>
                        </span>
                    </div>
                    <div class="col-6"><B>'.$Name.'</B></div>
                    <div class="col-4"><button type="button" class="btn btn-success btn-block" onClick="AddHabit('.$ID.', '.$UserID.')">Dodaj</button></div>
                </div>
                <br><br>
			';
        }
        
        echo $List;
    }

    function PlantLevel($Connect, $UserID){
        $result = mysqli_query($Connect, "SELECT * FROM persona WHERE UserID='$UserID'");
    	$row = $result->fetch_assoc();
		$Score = $row['Score'];

        $Level = intval($Score/25);

        $Connect->query("UPDATE persona SET Level='$Level' WHERE UserID='$UserID'");
    }

    function SizePlant($Connect, $UserID){
        $result = mysqli_query($Connect, "SELECT * FROM persona WHERE UserID='$UserID'");
    	$row = $result->fetch_assoc();
		$Level = $row['Level'];

        if($Level<25) $return = "M";
        else $return = "D";

        return $return;
    }

    function DryPlant($Connect, $UserID, $WaterID){
        $result = mysqli_query($Connect, "SELECT * FROM persona WHERE UserID='$UserID'");
    	$row = $result->fetch_assoc();
        $Min_water = $row['Min_water'];

        $Water = GetWater($Connect, $UserID, $WaterID);
        if($Water<$Min_water/2) $return = "S";
        else $return = "N";

        return $return;
    }

    function GetWater($Connect, $UserID, $WaterID){
        $DayNow = date("d");
		$MonthNow = date("m");
		$YearNow = date("Y");
        
        $result = mysqli_query($Connect, "SELECT * FROM `historyhabits` WHERE `UpdateTime` LIKE '%$YearNow-$MonthNow-$DayNow%' AND `HabitsID` = '$WaterID' AND `UserID` = '$UserID'");
        while($row=mysqli_fetch_array($result)){
            $Water += $row['Water'];
        }

        return $Water;
    }

    function GetLocWea($OWMKey){
        $geo = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));

        $latitude = $geo['geoplugin_latitude'];
        $longitude = $geo['geoplugin_longitude'];

        $json = file_get_contents('http://api.openweathermap.org/data/2.5/weather?lat='.$latitude.'&lon='.$longitude.'&APPID='.$OWMKey);
        $data = json_decode($json, true);

        $Temperature = $data['main']['temp'] - 273.15;
        $Temperature = round($Temperature,2);
        $Humidity = $data['main']['humidity'];
    }

?>