<?php
header("Content-Type: application/json");
require "db.php";

$id = $_POST['id'] ?? null; // for edit
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$complaint = $_POST['complaint'] ?? '';

if($id){
    $sql = "UPDATE complaints SET name='$name', email='$email', complaint='$complaint' WHERE id=$id";
    $msg = "Complaint updated";
} else {
    $sql = "INSERT INTO complaints (name,email,complaint) VALUES ('$name','$email','$complaint')";
    $msg = "Complaint submitted";
}

if(mysqli_query($conn,$sql)){
    echo json_encode(["status"=>"success","message"=>$msg]);
} else {
    echo json_encode(["status"=>"error","message"=>"Database error: ".mysqli_error($conn)]);
}
?>

