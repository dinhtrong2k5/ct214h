<?php
include("../../includes/db-connect.php");
?>

<form method="POST">

    <select name="destination_id">
        <?php
        $res = $conn->query("SELECT * FROM destinations");
        while ($d = $res->fetch_assoc()) {
        ?>
            <option value="<?= $d['id'] ?>"><?= $d['name'] ?></option>
        <?php } ?>
    </select>

    <input name="day_number">
    <input name="title">
    <textarea name="description"></textarea>

    <button name="add">Save</button>

</form>

<?php
if (isset($_POST['add'])) {

    $conn->query("
INSERT INTO tour_itineraries(destination_id,day_number,title,description)
VALUES(
{$_POST['destination_id']},
{$_POST['day_number']},
'{$_POST['title']}',
'{$_POST['description']}'
)
");

    echo "<script>alert('Added');location='list.php';</script>";
}
?>