<?php
function getDB(){
$db_host = "localhost";
$db_name ="braniellaofficialstore";
$db_user ="dane_www";
$db_pass = "BAsW)vGOlOcqT/ih";

$conn = mysqli_connect($db_host, $db_user,$db_pass, $db_name);

if(mysqli_connect_error()){
    echo mysqli_connect_error(); 
    exit;
}
return $conn;
}
 ?>