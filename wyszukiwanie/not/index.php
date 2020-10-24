<?php
$regId ="fdsgfadgdfah";


// INCLUDE YOUR FCM FILE
include_once 'fcm.php';    

$notification = array();
$arrNotification= array();			
$arrData = array();											
$arrNotification["body"] ="Test by Vijay.";
$arrNotification["title"] = "PHP ADVICES";
$arrNotification["sound"] = "default";
$arrNotification["type"] = 1;

$fcm = new FCM();
$result = $fcm->send_notification($regId, $arrNotification,"Android");

?>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-analytics.js"></script>

<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyAtdK_k8Ay5sE3LdJI9U9eSOTCn9xQipXY",
    authDomain: "cgtranslate.firebaseapp.com",
    databaseURL: "https://cgtranslate.firebaseio.com",
    projectId: "cgtranslate",
    storageBucket: "cgtranslate.appspot.com",
    messagingSenderId: "276631582154",
    appId: "1:276631582154:web:879d7630b843a8b74e0b33",
    measurementId: "G-WRWB80Q77Z"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
</script>