<?php
include("../includes/db-connect.php");


$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
$sort = isset($_GET['sort']) ? $_GET['sort'] : "latest";
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";

$limit = 6;
$offset = ($page - 1) * $limit;

$where = "WHERE f.status = 1";

// -- CATEGORY--
if ($category_id > 0) {
    $where .= " AND f.food_category_id = $category_id";
}

// --SEARCH --
if ($keyword != "") {
    $where .= " AND f.name LIKE '%$keyword%'";
}

// --- XỬ LÝ SORT ---
$order_by = "f.created_at DESC"; // Mặc định

switch ($sort) {
    case 'price_asc':
        $order_by = "f.price_min ASC";
        break;
    case 'price_desc':
        $order_by = "f.price_min DESC";
        break;
    case 'name_asc':
        $order_by = "f.name ASC";
        break;
    case 'latest':
    default:
        $order_by = "f.created_at DESC";
        break;
}

// -- PHÂN TRANG--
$sql_total = " SELECT COUNT(*) AS total FROM foods f $where";

$result_total = $conn->query($sql_total);
$total = $result_total->fetch_assoc()['total'];
$total_pages = ceil($total / $limit);


if ($total_pages > 0) {
    if ($page > $total_pages) $page = $total_pages;
} else {
    $page = 1;
}


// ===== TRUY VẤN DỮ LIỆU =====
$sql = " SELECT * FROM foods f 
        $where 
        ORDER BY $order_by
        LIMIT $offset, $limit";

$result = $conn->query($sql);


// Tạo biến lưu trữ HTML cho danh sách món ăn
$food_html = "";
$count = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $count++;
        $food_html .= "
        <div class='food-card' onclick=openFoodDetail({$row['food_id']})>
            <img src='../images/foods/{$row['main_image']}'>
            <h3>{$row['name']}</h3>
            <p>" . number_format($row['price_min']) . " - " . number_format($row['price_max']) . " VND</p>
        </div>";
    }
    // Card rỗng để giữ layout
    for ($i = $count; $i < $limit; $i++) {
        $food_html .= "<div class='food-card empty'></div>";
    }
} else {
    $food_html = "<p>No food found.</p>";
}

// Tạo biến lưu trữ HTML cho phân trang
$pagination_html = "";
if ($total_pages > 1) {
    if ($page > 1) {
        $pagination_html .= "<button onclick='loadFood(" . ($page - 1) . ")'>Prev</button>";
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        $active = ($i == $page) ? "class='active-page'" : "";
        $pagination_html .= "<button $active onclick='loadFood($i)'>$i</button>";
    }
    if ($page < $total_pages) {
        $pagination_html .= "<button onclick='loadFood(" . ($page + 1) . ")'>Next</button>";
    }
}

// TRẢ VỀ JSON
echo json_encode([
    'food_list' => $food_html,
    'pagination' => $pagination_html
]);
