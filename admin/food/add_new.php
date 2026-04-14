<?php
include("../../includes/db-connect.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Add Food</title>
    <link rel="stylesheet" href="../assets/css/admin_food.css">
</head>

<body>

    <form method="POST" enctype="multipart/form-data">

        <input name="name" placeholder="Name"><br>
        <textarea name="description"></textarea><br>

        <input name="price_min" type="number"><br>
        <input name="price_max" type="number"><br>

        <select name="food_category_id">
            <?php
            $cats = $conn->query("SELECT * FROM food_categories");
            while ($c = $cats->fetch_assoc()) {
            ?>
                <option value="<?= $c['food_category_id'] ?>"><?= $c['name'] ?></option>
            <?php } ?>
        </select><br>

        <select name="locations[]" multiple>
            <?php
            $locs = $conn->query("SELECT * FROM food_locations");
            while ($l = $locs->fetch_assoc()) {
            ?>
                <option value="<?= $l['food_location_id'] ?>">
                    <?= $l['name'] ?> - <?= $l['address'] ?>
                </option>
            <?php } ?>
        </select><br>

        <input type="file" name="main_image"><br>
        <input type="file" name="sub_image_1"><br>
        <input type="file" name="sub_image_2"><br>

        <button name="add_food">Save</button>

    </form>

    <?php
    if (isset($_POST['add_food'])) {

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $desc = mysqli_real_escape_string($conn, $_POST['description']);
        $pmin = (int)$_POST['price_min'];
        $pmax = (int)$_POST['price_max'];
        $cat  = (int)$_POST['food_category_id'];

        $main_image = "";
        if ($_FILES['main_image']['error'] == 0) {
            $main_image = time() . "_" . $_FILES['main_image']['name'];
            move_uploaded_file($_FILES['main_image']['tmp_name'], "../../uploads/foods/" . $main_image);
        }

        $conn->query("
INSERT INTO foods(name,description,price_min,price_max,main_image,food_category_id)
VALUES('$name','$desc',$pmin,$pmax,'$main_image',$cat)
");

        $food_id = $conn->insert_id;

        if ($_FILES['sub_image_1']['error'] == 0) {
            $img = time() . "_1_" . $_FILES['sub_image_1']['name'];
            move_uploaded_file($_FILES['sub_image_1']['tmp_name'], "../../uploads/foods/" . $img);
            $conn->query("INSERT INTO food_image(food_id,image) VALUES($food_id,'$img')");
        }

        if ($_FILES['sub_image_2']['error'] == 0) {
            $img = time() . "_2_" . $_FILES['sub_image_2']['name'];
            move_uploaded_file($_FILES['sub_image_2']['tmp_name'], "../../uploads/foods/" . $img);
            $conn->query("INSERT INTO food_image(food_id,image) VALUES($food_id,'$img')");
        }

        $location_ids = [];

        if (isset($_POST['locations'])) {
            foreach ($_POST['locations'] as $loc) {
                $location_ids[] = (int)$loc;
            }
        }

        foreach ($location_ids as $loc) {
            $conn->query("INSERT INTO food_at_location(food_id,food_location_id) VALUES($food_id,$loc)");
        }

        echo "<script>alert('Added');location='list.php';</script>";
    }
    ?>