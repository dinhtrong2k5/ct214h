<?php
include("../../includes/db-connect.php");

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM cultures WHERE id=$id")->fetch_assoc();
?>

<form method="POST">

    <input name="title" value="<?= $data['title'] ?>"><br>
    <input name="slug" value="<?= $data['slug'] ?>"><br>
    <input name="event_date" value="<?= $data['event_date'] ?>"><br>
    <input name="location" value="<?= $data['location'] ?>"><br>

    <textarea name="content"><?= $data['content'] ?></textarea><br>

    <select name="status">
        <option value="1" <?= $data['status'] == 1 ? 'selected' : '' ?>>Active</option>
        <option value="0" <?= $data['status'] == 0 ? 'selected' : '' ?>>Hidden</option>
    </select>

    <button name="update">Update</button>

</form>

<?php
if (isset($_POST['update'])) {

    $conn->query("
UPDATE cultures SET
title='{$_POST['title']}',
slug='{$_POST['slug']}',
event_date='{$_POST['event_date']}',
location='{$_POST['location']}',
content='{$_POST['content']}',
status={$_POST['status']}
WHERE id=$id
");

    echo "<script>alert('Updated');location='list.php';</script>";
}
?>