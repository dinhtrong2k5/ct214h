<?php
include("../../includes/db-connect.php");

$id = (int)$_GET['id'];

if ($id <= 0) die("Invalid");

$res = $conn->query("SELECT main_image FROM foods WHERE food_id=$id");
$row = $res->fetch_assoc();

if ($row && $row['main_image']) {
    $path = "../../uploads/foods/" . $row['main_image'];
    if (file_exists($path)) unlink($path);
}

$res = $conn->query("SELECT * FROM food_image WHERE food_id=$id");
while ($img = $res->fetch_assoc()) {
    $path = "../../uploads/foods/" . $img['image'];
    if (file_exists($path)) unlink($path);
}

$conn->query("DELETE FROM food_image WHERE food_id=$id");
$conn->query("DELETE FROM food_at_location WHERE food_id=$id");
$conn->query("DELETE FROM foods WHERE food_id=$id");

echo "<script>alert('Deleted');location='list.php';</script>";
