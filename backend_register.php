<?php
header("Content-Type: application/json");
require "db.php";

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if($name && $email && $password){
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$hashed')";
    if(mysqli_query($conn,$sql)){
        echo json_encode(["status"=>"success","message"=>"Registered successfully"]);
    } else {
        echo json_encode(["status"=>"error","message"=>"Database error: ".mysqli_error($conn)]);
    }
} else {
    echo json_encode(["status"=>"error","message"=>"All fields are required"]);
}

?>
