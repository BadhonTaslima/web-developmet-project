<?php
header("Content-Type: application/json");
require "db.php";

$id = $_POST['id'] ?? null; // for edit
$name = $_POST['name'] ?? '';
$review = $_POST['review'] ?? '';

if($id){
    $sql = "UPDATE reviews SET name='$name', review='$review' WHERE id=$id";
    $msg = "Review updated";
} else {
    $sql = "INSERT INTO reviews (name,review) VALUES ('$name','$review')";
    $msg = "Review submitted";
}

if(mysqli_query($conn,$sql)){
    echo json_encode(["status"=>"success","message"=>$msg]);
} else {
    echo json_encode(["status"=>"error","message"=>"Database error: ".mysqli_error($conn)]);
}
?>
