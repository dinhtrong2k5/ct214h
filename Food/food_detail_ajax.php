<?php
include("../includes/db-connect.php");

if (!isset($_GET['id'])) {
    echo "Food not found!";
    exit();
}

$food_id = intval($_GET['id']);

// FOOD
$food = $conn->query("SELECT * FROM foods WHERE food_id = $food_id")->fetch_assoc();

// IMAGES
$images = $conn->query("SELECT * FROM food_image WHERE food_id = $food_id");

// LOCATIONS
$sql_loc = "
    SELECT fl.name, fl.address 
    FROM food_locations fl 
    JOIN food_at_location fal ON fl.food_location_id = fal.food_location_id
    WHERE fal.food_id = $food_id
";
$locations = $conn->query($sql_loc);
?>


<table class="food-detail-table">
    <?php
    // Lấy 2 ảnh đầu tiên
    $img1 = $images->fetch_assoc();
    $img2 = $images->fetch_assoc();
    ?>

    <tr>
        <td rowspan="2" class="main-image-cell">
            <img class="main-img"
                src="../images/foods/<?php echo $food['main_image']; ?>">
        </td>

        <td class="sub-image-cell">
            <?php if ($img1) { ?>
                <img class="sub-img" src="../images/foods/<?php echo $img1['image']; ?>">
            <?php } ?>
        </td>
    </tr>

    <tr>
        <td class="sub-image-cell">
            <?php if ($img2) { ?>
                <img class="sub-img" src="../images/foods/<?php echo $img2['image']; ?>">
            <?php } ?>
        </td>
    </tr>

    <tr>
        <td class="info-cell">
            <h1><?php echo $food['name']; ?></h1>

            <p class="price">
                <?php echo number_format($food['price_min']); ?> -
                <?php echo number_format($food['price_max']); ?> VND
            </p>

            <p class="description">
                <?php echo $food['description']; ?>
            </p>
        </td>

        <td class="location-cell">
            <h3>Suggested Locations</h3>

            <ul>
                <?php while ($loc = $locations->fetch_assoc()) { ?>
                    <li>
                        <b><?php echo $loc['name']; ?></b><br>
                        <?php echo $loc['address']; ?>
                    </li>
                <?php } ?>
            </ul>
        </td>
    </tr>

</table>