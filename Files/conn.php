<?php
session_start();
if(!isset($_SESSION['enrollid'])){
    header("Location: index.php");
}
else{
    $hotsname = "localhost";
    $username = "id16934540_cop";
    $password = "Teamshadow@000";
    $dbname = "id16934540_cmcop";
    $conn = mysqli_connect($hotsname,$username,$password,$dbname);
    date_default_timezone_set('Asia/Kolkata');
    if(!$conn){
        echo "error in connecting to database";
    }
    
}
?>