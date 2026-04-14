<?php
include("../../includes/db-connect.php");

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM destinations WHERE id=$id")->fetch_assoc();
?>

<form method="POST">

    <input name="name" value="<?= $data['name'] ?>">
    <input name="slug" value="<?= $data['slug'] ?>">
    <input name="address" value="<?= $data['address'] ?>">

    <textarea name="description"><?= $data['description'] ?></textarea>

    <select name="status">
        <option value="1" <?= $data['status'] == 1 ? 'selected' : '' ?>>Active</option>
        <option value="0" <?= $data['status'] == 0 ? 'selected' : '' ?>>Hidden</option>
    </select>

    <button name="update">Update</button>

</form>

<?php
if (isset($_POST['update'])) {

    $conn->query("
UPDATE destinations SET
name='{$_POST['name']}',
slug='{$_POST['slug']}',
address='{$_POST['address']}',
description='{$_POST['description']}',
status={$_POST['status']}
WHERE id=$id
");

    echo "<script>alert('Updated');location='list.php';</script>";
}
?>