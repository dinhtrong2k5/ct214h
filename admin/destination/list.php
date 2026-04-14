<?php
include("../../includes/db-connect.php");

$result = $conn->query("SELECT * FROM destinations ORDER BY id DESC");
?>

<h2>Destination</h2>

<a href="add_new.php">Add</a>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Address</th>
        <th>Action</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['address'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>