<?php
header("Content-Type: application/json");
require "db.php";

$table = $_GET['table'] ?? '';
$search = $_GET['search'] ?? '';

$allowed = ['users','bookings','reviews','complaints'];
if(!in_array($table,$allowed)){
    echo json_encode(["status"=>"error","message"=>"Invalid table"]);
    exit;
}

$sql = "SELECT * FROM $table";
if($search){
    $sql .= " WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR review LIKE '%$search%' OR complaint LIKE '%$search%' OR destination LIKE '%$search%'";
}
$sql .= " ORDER BY id DESC";

$res = mysqli_query($conn,$sql);
$data = [];
while($row = mysqli_fetch_assoc($res)){
    $data[] = $row;
}

echo json_encode(["status"=>"success","data"=>$data]);
?>

