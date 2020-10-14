
<div id="bot"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                function GetDailyHabits(id){
                    $.get('Resources/Ajax/Bot.php',{id: id}, function(data){
                        $("#bot").html(data);
                    });
                }
				
                id=1;
				GetDailyHabits(id);
                setInterval(function(){
                    if(id>13579){
                        
                    }else{
                        id+=1;
					GetDailyHabits(id);
                    }
                    
                },1000);
            });
        </script>