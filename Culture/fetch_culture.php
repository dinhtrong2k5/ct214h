<?php
include('../includes/db-connect.php');

$search = isset($_POST['search']) ? trim($_POST['search']) : '';
$category = isset($_POST['category']) ? (int)$_POST['category'] : 1;

// SQL Tìm kiếm theo từ khóa trong danh mục đang chọn
$sql = "SELECT c.*, GROUP_CONCAT(ci.image ORDER BY ci.is_primary DESC) as all_images
        FROM cultures c
        LEFT JOIN culture_images ci ON c.id = ci.culture_id
        WHERE c.culture_category_id = ? 
          AND c.status = 1 
          AND (c.title LIKE ? OR c.content LIKE ? OR c.location LIKE ?) 
        GROUP BY c.id
        ORDER BY c.created_at DESC";

$stmt = $conn->prepare($sql);
$like_search = "%$search%";
$stmt->bind_param("isss", $category, $like_search, $like_search, $like_search);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $img_list = !empty($row['all_images']) ? explode(',', $row['all_images']) : [];
        $path_prefix = "../";
        $main_img = isset($img_list[0]) ? $path_prefix . trim($img_list[0]) : $path_prefix . 'images/placeholder.jpg';
        $sub_img1 = isset($img_list[1]) ? $path_prefix . trim($img_list[1]) : $path_prefix . 'images/placeholder.jpg';
        $sub_img2 = isset($img_list[2]) ? $path_prefix . trim($img_list[2]) : $path_prefix . 'images/placeholder.jpg';

        echo '<div class="culture-post">
                <h3 class="post-name">' . htmlspecialchars($row['title']) . '</h3>
                <div class="post-meta">
                    <span><i class="fa-solid fa-location-dot"></i> ' . htmlspecialchars($row['location']) . '</span>
                    <span> | <i class="fa-regular fa-calendar"></i> ' . htmlspecialchars($row['event_date']) . '</span>
                </div>
                <p class="post-desc">' . nl2br(htmlspecialchars($row['content'])) . '</p>
                <div class="photo-collage">
                    <div class="photo-large"><img src="' . $main_img . '" class="square-img"></div>
                    <div class="photo-small-group">
                        <div class="photo-small"><img src="' . $sub_img1 . '" class="square-img"></div>
                        <div class="photo-small"><img src="' . $sub_img2 . '" class="square-img"></div>
                    </div>
                </div>
                <hr class="post-divider">
              </div>';
    }
} else {
    echo '<p style="text-align:center; padding: 50px;">No matches found for your search.</p>';
}
