<?php
include("../../includes/db-connect.php");

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM tour_itineraries WHERE id=$id")->fetch_assoc();
?>

<form method="POST">

    <input name="day_number" value="<?= $data['day_number'] ?>">
    <input name="title" value="<?= $data['title'] ?>">
    <textarea name="description"><?= $data['description'] ?></textarea>

    <button name="update">Update</button>

</form>

<?php
if (isset($_POST['update'])) {

    $conn->query("
UPDATE tour_itineraries SET
day_number={$_POST['day_number']},
title='{$_POST['title']}',
description='{$_POST['description']}'
WHERE id=$id
");

    echo "<script>alert('Updated');location='list.php';</script>";
}
?>