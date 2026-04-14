<?php
include("../../includes/db-connect.php");

$id = $_GET['id'];

$res = $conn->query("SELECT * FROM destination_images WHERE destination_id=$id");

while ($img = $res->fetch_assoc()) {
    $path = "../../" . $img['image'];
    if (file_exists($path)) unlink($path);
}

$conn->query("DELETE FROM destination_images WHERE destination_id=$id");
$conn->query("DELETE FROM destinations WHERE id=$id");

echo "<script>alert('Deleted');location='list.php';</script>";
