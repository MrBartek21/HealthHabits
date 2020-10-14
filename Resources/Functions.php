<?php
    function GenerateColor($hex, $steps, $style){
        $color = adjustBrightness($hex, $steps);
        $return = 'style="background-color: #'.$color.';'.$style.'"';
        
        echo $return;
    }
    
    function adjustBrightness($hex, $steps){
        $steps = max(-255, min(255, $steps));
    
        $hex = str_replace('#', '', $hex);
        if(strlen($hex) == 3)$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
        
        $color_parts = str_split($hex, 2);
    
        foreach($color_parts as $color){
            $color   = hexdec($color);
            $color   = max(0,min(255,$color + $steps));
            $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT);
        }
        return $return;
    }

    function login($Connect, $Login, $Pass){
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try{
			if($Connect->connect_errno!=0){
				throw new Exception(mysqli_connect_errno());
			}else{
				$Login = htmlentities($Login, ENT_QUOTES, "UTF-8");
			
				if ($rezult = $Connect->query(sprintf("SELECT * FROM users WHERE User='%s'", mysqli_real_escape_string($Connect,$Login)))){
					$count = $rezult->num_rows;
					if($count>0){
						$row = $rezult->fetch_assoc();
						if(password_verify($Pass, $row['Pass'])){
							$_SESSION['HH_Logged'] = true;
							$_SESSION['HH_ID'] = $row['ID'];
							$_SESSION['HH_User'] = $row['User'];
							
							$ID = $row['ID'];
							$IP = $_SERVER["REMOTE_ADDR"];
							
							$Connect->query("UPDATE users SET LastLogin = now() WHERE ID = '$ID'");
							$Connect->query("UPDATE users SET IP = '$IP' WHERE ID = '$ID'");
							
							unset($_SESSION['error']);
							$rezult->free_result();
							
							header('Location: index.php');
						}else{
							$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$Lang_LoginPass.'</div>';
							header('Location: login.php');
						}
					}else{
						$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$Lang_LoginLogin.'</div>';
						header('Location: login.php');
					}
				}else{
					throw new Exception($Connect->error);
				}
				$Connect->close();
			}
		}catch(Exception $e){
			$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$Lang_Error1.'</div>';
			$_SESSION['error'] .= '<div class="alert alert-danger text-center" role="alert">'.$Lang_Error2.' '.$e.'</div>';
		}
	}
	
	function register($Connect, $Login, $Email, $Pass1, $Pass2){
		mysqli_report(MYSQLI_REPORT_STRICT);
		//include("Lang/$Lang.php");
		include("Resources/Config.php");
		
		
		$OK = true;
        //Sprawdzenie długości nicka
        if((strlen($Login)<3) || (strlen($Login)>20)){
            $OK = false;
			$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$Lang_ERegisterLogin1.'</div>';
        }
        
        if(ctype_alnum($Login)==false){
            $OK = false;
			$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$Lang_ERegisterLogin2.'</div>';
        }
        
        // Sprawdź poprawność adresu email
        $Email2 = filter_var($Email, FILTER_SANITIZE_EMAIL);
        
        if((filter_var($Email2, FILTER_VALIDATE_EMAIL)==false) || ($Email2!=$Email)){
            $OK = false;
			$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$Lang_ERegisterEmail1.'</div>';
        }
        
        //Sprawdź poprawność hasła
        if((strlen($Pass1)<8) || (strlen($Pass1)>20)){
            $OK = false;
			$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$Lang_ERegisterPass1.'</div>';
        }
        
        if($Pass1!=$Pass2){
            $OK = false;
			$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$Lang_ERegisterPass2.'</div>';
        }
        
        $Pass_Hash = password_hash($Pass1, PASSWORD_DEFAULT);
        try{
            if($Connect->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }else{
                //Czy email już istnieje?
                $rezult = $Connect->query("SELECT ID FROM users WHERE Email='$Email'");
                
                if(!$rezult) throw new Exception($Connect->error);
                
                $count = $rezult->num_rows;
                if($count>0){
                    $OK = false;
					$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$Lang_ERegisterEmail2.'</div>';
                }
                
                //Czy login jest już zarezerwowany?
                $rezult = $Connect->query("SELECT ID FROM users WHERE Login='$Login'");
                
                if (!$rezult) throw new Exception($Connect->error);

                $count = $rezult->num_rows;
                if($count>0){
                    $OK = false;
					$_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$Lang_ERegisterLogin3.'</div>';
                }
                
                if($OK==true){
                    $IP = $_SERVER['REMOTE_ADDR'];
                    
                    if($Connect->query("INSERT INTO users VALUES (NULL, '$Login', '$Pass_Hash', '$Email', '$IP', now(), 0)")){
						$_SESSION['error'] = '<div class="alert alert-success text-center" role="alert">Zarejestrowano pomyślnie</div>';
                        $_SESSION['Registered'] = true;
                        header('Location: index.php');
                    }else{
                        throw new Exception($Connect->error);
                    }
                }
                $Connect->close();
            }
        }catch(Exception $e){
            $_SESSION['error'] = '<div class="alert alert-danger text-center" role="alert">'.$Lang_Error1.'</div>';
			$_SESSION['error'] .= '<div class="alert alert-danger text-center" role="alert">'.$Lang_Error2.' '.$e.'</div>';
        }
	}
?>