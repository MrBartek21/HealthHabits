
<!DOCTYPE html>
<html lang="pl">

    <body>
    
        <li class="nav-item text-uppercase nav-link dropdown-toggle pointer font-nav" id="dropdown_user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Produkt</li>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown_user">
								<form class="px-4 py-2">
								<input type="search" class="form-control search" placeholder="Wyszukaj..." autofocus="autofocus"  onkeyup="showResult(this.value)">
							</form>
							<div class="menuItems" id="livesearch"></div>
							</div>
							
		<div id="SP"></div>
        
		<!-- Ajax JS-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
			function showResult(str){
				if(str.length==0){
					document.getElementById("livesearch").innerHTML="";
					document.getElementById("livesearch").style.border="0px";
					return;
				}
				
				if(window.XMLHttpRequest){
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp=new XMLHttpRequest();
				}else{  // code for IE6, IE5
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

        
        
        
        

        
        
        function sendproducts(id){
        
            $(document).ready(function(){
                $.get('Resources/AJAX/SendProducts.php', {ProductsID: id}, function(data){
                    console.log(id);
    
                });
            });
        }
        
        //odświeżanie co sek
        $(document).ready(function(){
            //karty odpowiedzi
            function showproducts(){
                $.get('Resources/AJAX/ShowProducts.php', function(data){
                    $("#SP").html(data);
                });
            }
            
            showproducts();
            setInterval(function(){
        	    showproducts();
            },1000);
        });
        
        


		
		</script>
    </body>
</html>
