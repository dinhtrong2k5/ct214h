<?php
include('../includes/db-connect.php');

// Lấy các tham số từ URL
$search_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$category_id = isset($_GET['category']) ? (int)$_GET['category'] : 1;

// 1. Xác định tiêu đề hiển thị
$display_title = 'Culture';
if ($search_id > 0) {
    $display_title = "Highlight"; // Hoặc có thể query lấy tên bài viết
} else {
    $cat_stmt = $conn->prepare("SELECT name FROM culture_categories WHERE culture_category_id = ?");
    $cat_stmt->bind_param("i", $category_id);
    $cat_stmt->execute();
    $cat_res = $cat_stmt->get_result();
    if ($cat_row = $cat_res->fetch_assoc()) {
        $display_title = $cat_row['name'];
    }
}

// 2. Truy vấn dữ liệu ban đầu
// Nếu có search_id (từ View More), hiện đúng bài đó. Nếu không, hiện theo Category.
if ($search_id > 0) {
    $sql = "SELECT c.*, GROUP_CONCAT(ci.image ORDER BY ci.is_primary DESC) as all_images
            FROM cultures c
            LEFT JOIN culture_images ci ON c.id = ci.culture_id
            WHERE c.id = ? AND c.status = 1
            GROUP BY c.id";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $search_id);
} else {
    $sql = "SELECT c.*, GROUP_CONCAT(ci.image ORDER BY ci.is_primary DESC) as all_images
            FROM cultures c
            LEFT JOIN culture_images ci ON c.id = ci.culture_id
            WHERE c.culture_category_id = ? AND c.status = 1
            GROUP BY c.id
            ORDER BY c.created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $category_id);
}
$stmt->execute();
$default_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($display_title); ?> - Discover Can Tho</title>
    <link rel="stylesheet" href="../css/Home/style.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/Culture/culture.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #backToTop {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 9999;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #2e7d32;
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <?php include('../Header/header.php'); ?>

    <section class="culture-banner">
        <div class="banner-overlay">
            <h1 class="banner-title Breathing">CULTURE</h1>
        </div>
    </section>

    <section id="culture-content" class="quick-filter-section">
        <div class="filter-container">
            <div class="filter-left">
                <h3>TYPE OF CULTURE</h3>
                <div class="filter-tags">
                    <a href="Culture.php?category=1#culture-content" class="tag-link <?php echo ($category_id == 1 && $search_id == 0) ? 'active' : ''; ?>">Festival</a>
                    <a href="Culture.php?category=2#culture-content" class="tag-link <?php echo ($category_id == 2 && $search_id == 0) ? 'active' : ''; ?>">Traditional Craft Villages</a>
                </div>
            </div>
            <div class="search-bar-mini">
                <input type="text" id="liveSearch" placeholder="Type to search..." autocomplete="off">
                <button type="button"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </section>

    <div class="article-container">
        <h2 class="festival-title-main" id="dynamic-title"><?php echo htmlspecialchars($display_title); ?></h2>

        <div id="search-results">
            <?php if ($default_result->num_rows > 0): ?>
                <?php while ($row = $default_result->fetch_assoc()):
                    $img_list = !empty($row['all_images']) ? explode(',', $row['all_images']) : [];
                    $path_prefix = "../";
                    $main_img = isset($img_list[0]) ? $path_prefix . trim($img_list[0]) : $path_prefix . 'images/placeholder.jpg';
                    $sub_img1 = isset($img_list[1]) ? $path_prefix . trim($img_list[1]) : $path_prefix . 'images/placeholder.jpg';
                    $sub_img2 = isset($img_list[2]) ? $path_prefix . trim($img_list[2]) : $path_prefix . 'images/placeholder.jpg';
                ?>
                    <div class="culture-post">
                        <h3 class="post-name"><?php echo htmlspecialchars($row['title']); ?></h3>
                        <div class="post-meta">
                            <span><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($row['location']); ?></span>
                            <span> | <i class="fa-regular fa-calendar"></i> <?php echo htmlspecialchars($row['event_date']); ?></span>
                        </div>
                        <p class="post-desc"><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
                        <div class="photo-collage">
                            <div class="photo-large"><img src="<?php echo $main_img; ?>" class="square-img"></div>
                            <div class="photo-small-group">
                                <div class="photo-small"><img src="<?php echo $sub_img1; ?>" class="square-img"></div>
                                <div class="photo-small"><img src="<?php echo $sub_img2; ?>" class="square-img"></div>
                            </div>
                        </div>
                        <hr class="post-divider">
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="text-align:center;">No data found.</p>
            <?php endif; ?>
        </div>
    </div>

    <button id="backToTop" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">
        <i class="fa fa-arrow-up"></i>
    </button>

    <?php include('../Footer/footer.php'); ?>

    <script>
        $(document).ready(function() {
            $("#liveSearch").on("keyup", function() {
                let keyword = $(this).val();
                let catId = "<?php echo $category_id; ?>";

                // Khi người dùng gõ search, đổi tiêu đề thành "Search Results"
                if (keyword.length > 0) {
                    $("#dynamic-title").text("");
                } else {
                    $("#dynamic-title").text("<?php echo $display_title; ?>");
                }

                $.ajax({
                    url: "fetch_culture.php",
                    type: "POST",
                    data: {
                        search: keyword,
                        category: catId
                    },
                    success: function(response) {
                        $("#search-results").html(response);
                    }
                });
            });
        });
    </script>
</body>

</html>