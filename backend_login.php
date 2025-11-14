<?php
header("Content-Type: application/json");
session_start();
require "db.php";

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if($email && $password){
    $sql = "SELECT * FROM users WHERE email='$email'";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
        $user = mysqli_fetch_assoc($res);
        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            echo json_encode(["status"=>"success","message"=>"Login successful"]);
        } else {
            echo json_encode(["status"=>"error","message"=>"Invalid password"]);
        }
    } else {
        echo json_encode(["status"=>"error","message"=>"User not found"]);
    }
} else {
    echo json_encode(["status"=>"error","message"=>"Email and password required"]);
}
?>

