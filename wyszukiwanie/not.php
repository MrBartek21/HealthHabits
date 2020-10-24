<body>
        <script src="Vendor/jquery/jquery.min.js"></script>
    	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            function doPoll() {
                // Get the JSON
                $.ajax({ url: 'nottext.json', success: function(data){
                    if(data.notify) {
                        // Yeah, there is a new notification! Show it to the user
                        var notification = new Notification(data.title, {
                             icon:'https://lh3.googleusercontent.com/-aCFiK4baXX4/VjmGJojsQ_I/AAAAAAAANJg/h-sLVX1M5zA/s48-Ic42/eggsmall.png',
                             body: data.desc,
                         });
                         notification.onclick = function () {
                             window.open(data.url);      
                         };
                    }
                    // Retry after a second
                    setTimeout(doPoll,1000);
                }, dataType: "json"});
            }
            if (Notification.permission !== "granted")
            {
                // Request permission to send browser notifications
                Notification.requestPermission().then(function(result) {
                    if (result === 'default') {
                        // Permission granted
                        doPoll();
                    }
                });
            } else {
                doPoll();
            }
            
        </script>
</body>