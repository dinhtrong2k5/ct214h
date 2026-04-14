<?php
include("../../includes/db-connect.php");

$result = $conn->query("SELECT * FROM tour_itineraries ORDER BY id DESC");
?>

<h2>Itinerary</h2>

<a href="add_new.php">Add</a>

<table border="1">
    <tr>
        <th>Day</th>
        <th>Title</th>
        <th>Action</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['day_number'] ?></td>
            <td><?= $row['title'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>