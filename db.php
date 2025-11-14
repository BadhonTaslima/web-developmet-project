<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "gobeyond";

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn){
    die(json_encode(["status"=>"error","message"=>"Database connection failed: ".mysqli_connect_error()]));
}
?>

