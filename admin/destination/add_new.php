<?php
include("../../includes/db-connect.php");
?>

<form method="POST">

    <input name="name">
    <input name="slug">
    <input name="address">
    <textarea name="description"></textarea>

    <select name="status">
        <option value="1">Active</option>
        <option value="0">Hidden</option>
    </select>

    <button name="add">Save</button>

</form>

<?php
if (isset($_POST['add'])) {

    $conn->query("
INSERT INTO destinations(name,slug,address,description,status)
VALUES(
'{$_POST['name']}',
'{$_POST['slug']}',
'{$_POST['address']}',
'{$_POST['description']}',
{$_POST['status']}
)
");

    echo "<script>alert('Added');location='list.php';</script>";
}
?>