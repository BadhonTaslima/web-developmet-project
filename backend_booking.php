<?php
header("Content-Type: application/json");
require "db.php";

$id = $_POST['id'] ?? null; // for edit
$name = $_POST['name'] ?? '';
$destination = $_POST['destination'] ?? '';
$date = $_POST['date'] ?? '';
$guests = $_POST['guests'] ?? '';

if($id){ // edit booking
    $sql = "UPDATE bookings SET name='$name', destination='$destination', date='$date', guests='$guests' WHERE id=$id";
    $msg = "Booking updated";
} else { // add new booking
    $sql = "INSERT INTO bookings (name,destination,date,guests) VALUES ('$name','$destination','$date','$guests')";
    $msg = "Booking saved";
}

if(mysqli_query($conn,$sql)){
    echo json_encode(["status"=>"success","message"=>$msg]);
} else {
    echo json_encode(["status"=>"error","message"=>"Database error: ".mysqli_error($conn)]);
}
?>
