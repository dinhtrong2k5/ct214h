<?php
include("../../includes/db-connect.php");

$id = (int)$_GET['id'];

$res = $conn->query("SELECT * FROM culture_images WHERE culture_id=$id");

while ($img = $res->fetch_assoc()) {
    $path = "../../" . $img['image'];
    if (file_exists($path)) unlink($path);
}

$conn->query("DELETE FROM culture_images WHERE culture_id=$id");
$conn->query("DELETE FROM cultures WHERE id=$id");

echo "<script>alert('Deleted');location='list.php';</script>";
