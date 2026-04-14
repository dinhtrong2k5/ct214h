<?php
include("../../includes/db-connect.php");

$id = (int)$_GET['id'];

$food = $conn->query("SELECT * FROM foods WHERE food_id=$id")->fetch_assoc();

$food_locs = [];
$res = $conn->query("SELECT food_location_id FROM food_at_location WHERE food_id=$id");
while ($r = $res->fetch_assoc()) {
    $food_locs[] = $r['food_location_id'];
}
?>

<form method="POST" enctype="multipart/form-data">

    <input name="name" value="<?= $food['name'] ?>"><br>
    <textarea name="description"><?= $food['description'] ?></textarea><br>

    <input name="price_min" value="<?= $food['price_min'] ?>"><br>
    <input name="price_max" value="<?= $food['price_max'] ?>"><br>

    <input type="file" name="main_image"><br>
    <input type="file" name="sub_image_1"><br>
    <input type="file" name="sub_image_2"><br>

    <button name="update_food">Update</button>

</form>

<?php
if (isset($_POST['update_food'])) {

    $updates = [];

    if ($_POST['name'] != $food['name']) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $updates[] = "name='$name'";
    }

    if ($_POST['description'] != $food['description']) {
        $desc = mysqli_real_escape_string($conn, $_POST['description']);
        $updates[] = "description='$desc'";
    }

    if ($_FILES['main_image']['error'] == 0) {
        $img = time() . "_" . $_FILES['main_image']['name'];
        move_uploaded_file($_FILES['main_image']['tmp_name'], "../../uploads/foods/" . $img);
        $updates[] = "main_image='$img'";
    }

    if (!empty($updates)) {
        $sql = implode(",", $updates);
        $conn->query("UPDATE foods SET $sql WHERE food_id=$id");
    }

    echo "<script>alert('Updated');location='list.php';</script>";
}
?>