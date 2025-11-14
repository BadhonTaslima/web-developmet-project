<?php
header("Content-Type: application/json");
require "db.php";

$table = $_POST['table'] ?? '';
$id = $_POST['id'] ?? '';

$allowed = ['users','bookings','reviews','complaints'];
if(!$table || !$id || !in_array($table,$allowed)){
    echo json_encode(["status"=>"error","message"=>"Invalid parameters"]);
    exit;
}

$sql = "DELETE FROM $table WHERE id=$id";
if(mysqli_query($conn,$sql)){
    echo json_encode(["status"=>"success","message"=>"Record deleted"]);
} else {
    echo json_encode(["status"=>"error","message"=>"Database error: ".mysqli_error($conn)]);
}
?>

