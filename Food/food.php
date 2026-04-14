<?php
// 1. Kết nối DB
include("../includes/db-connect.php");

// 2. Lấy food_id từ URL (Dùng khi nhấn "View More" từ trang chủ)
$food_id = isset($_GET['food_id']) ? (int)$_GET['food_id'] : 0;

// 3. Lấy danh sách Categories
$categories = $conn->query("SELECT * FROM food_categories ORDER BY food_category_id ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuisine - Discover Can Tho</title>

    <link rel="stylesheet" href="../css/Food/food.css">
    <link rel="stylesheet" href="../css/Home/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="../js/food_ajax.js"></script>
</head>

<body>
    <?php include "../Header/header.php"; ?>

    <div class="banner">
        <h1>CUISINE</h1>
    </div>

    <div class="food-header">
        <h2 class="title">Food & Drink</h2>
        <input type="text" id="search-input" placeholder="Search food..." onkeyup="searchFood()">
    </div>

    <div class="filter-toolbar">
        <div class="category-container">
            <button class="category-btn active" onclick="filterCategory(0, this)">All</button>
            <?php if ($categories->num_rows > 0): ?>
                <?php while ($cat = $categories->fetch_assoc()): ?>
                    <button class="category-btn" onclick="filterCategory(<?php echo $cat['food_category_id']; ?>, this)">
                        <?php echo htmlspecialchars($cat['name']); ?>
                    </button>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>

        <div class="sort-wrapper">
            <label for="sort-select">Sort by:</label>
            <select id="sort-select" onchange="loadFood(1)" class="sort-dropdown">
                <option value="latest">Latest Update</option>
                <option value="price_asc">Price: Low to High</option>
                <option value="price_desc">Price: High to Low</option>
                <option value="name_asc">Name: A - Z</option>
            </select>
        </div>
    </div>

    <div id="food-container">
        <div id="food-list" class="food-grid"></div>
    </div>

    <div id="pagination-container"></div>

    <div id="foodModal" class="modal" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.85); overflow-y:auto;">
        <div class="modal-content" style="background:#fff; margin:2% auto; width:95%; max-width:1100px; position:relative; border-radius:15px; overflow:hidden;">
            <span class="close-btn" onclick="closeModal()" style="position:absolute; right:20px; top:10px; font-size:40px; cursor:pointer; color:#ff4d4d; z-index:1000;">&times;</span>
            <div id="modal-body"></div>
        </div>
    </div>

    <?php include "../Footer/footer.php"; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // 1. Tải danh sách món ăn
            if (typeof loadFood === "function") {
                loadFood(1);
            }

            // 2. TỰ ĐỘNG MỞ CHI TIẾT NẾU CÓ ID TỪ TRANG CHỦ TRUYỀN SANG
            <?php if ($food_id > 0): ?>
                setTimeout(function() {
                    // Gọi hàm mở Modal (Sử dụng tên hàm openFoodDetail khớp với fetch_food.php)
                    if (typeof openFoodDetail === "function") {
                        openFoodDetail(<?php echo $food_id; ?>);
                    }
                }, 500); // Chờ 0.5s để trang ổn định rồi mới bật Popup
            <?php endif; ?>
        });

        // Hàm đóng modal
        function closeModal() {
            document.getElementById('foodModal').style.display = "none";
        }
    </script>
</body>

</html>