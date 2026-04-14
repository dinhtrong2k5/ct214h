<?php
include("../../includes/db-connect.php");

$id = $_GET['id'];

$conn->query("DELETE FROM tour_itineraries WHERE id=$id");

echo "<script>alert('Deleted');location='list.php';</script>";
