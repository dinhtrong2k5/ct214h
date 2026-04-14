<?php
include("../../includes/db-connect.php");

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM foods WHERE 1";

if ($search != "") {
    $search = mysqli_real_escape_string($conn, $search);
    $sql .= " AND name LIKE '%$search%'";
}

$sql .= " ORDER BY food_id DESC";

$result = $conn->query($sql);
?>

<h2>Food List</h2>

<form>
    <input name="search" value="<?= $search ?>">
    <button>Search</button>
</form>

<a href="add_new.php">Add</a>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Action</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['price_min'] ?> - <?= $row['price_max'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['food_id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $row['food_id'] ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>

</table>