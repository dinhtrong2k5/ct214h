<?php
include("../../includes/db-connect.php");

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM cultures WHERE 1";

if ($search != "") {
    $search = mysqli_real_escape_string($conn, $search);
    $sql .= " AND title LIKE '%$search%'";
}

$sql .= " ORDER BY id DESC";

$result = $conn->query($sql);
?>

<h2>Culture</h2>

<form>
    <input name="search" value="<?= $search ?>">
    <button>Search</button>
</form>

<a href="add_new.php">Add</a>

<table border="1">
    <tr>
        <th>Title</th>
        <th>Location</th>
        <th>Action</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['title'] ?></td>
            <td><?= $row['location'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>