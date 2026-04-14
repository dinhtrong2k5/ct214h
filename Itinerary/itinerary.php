<?php
// Sửa đường dẫn lùi 1 cấp để vào thư mục includes
require_once('../includes/db-connect.php');

// 1. Determine the current category and page
$current_slug = isset($_GET['slug']) ? $_GET['slug'] : 'all';
$current_slug = $conn->real_escape_string($current_slug);

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 8;
$offset = ($page - 1) * $limit;

// 2. Process query based on the selected category
if ($current_slug === 'all') {
    $category = array(
        'section_title' => 'ALL ITINERARIES',
        'section_desc' => 'Explore all our curated tours across Can Tho and the Mekong Delta.'
    );
    $count_query = "SELECT COUNT(*) as total FROM tours";
    $tours_query = "SELECT * FROM tours ORDER BY id ASC LIMIT $limit OFFSET $offset";
} else {
    $cat_query = "SELECT * FROM tour_categories WHERE slug = '$current_slug'";
    $cat_result = $conn->query($cat_query);

    if ($cat_result->num_rows > 0) {
        $category = $cat_result->fetch_assoc();
        $category_id = $category['id'];

        $count_query = "SELECT COUNT(*) as total FROM tours WHERE category_id = $category_id";
        $tours_query = "SELECT * FROM tours WHERE category_id = $category_id ORDER BY id ASC LIMIT $limit OFFSET $offset";
    } else {
        die("Category not found!");
    }
}

// 3. Calculate total pages for pagination
$count_result = $conn->query($count_query);
$total_rows = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

$all_cats_query = "SELECT * FROM tour_categories ORDER BY id ASC";
$all_cats_result = $conn->query($all_cats_query);
$tours_result = $conn->query($tours_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $category['section_title']; ?> - Discover Can Tho</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="../css/Itinerary/itinerary.css?v=2">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>

<body>
    <?php
    // Nhúng Header từ thư mục Header (Lùi 1 cấp)
    require_once '../Header/header.php';
    ?>

    <section class="hero-banner">
        <h1 class="brush-text">ITINERARY</h1>
    </section>

    <main class="main-content">
        <aside class="sidebar">
            <div class="sidebar-image">
                <img src="../images/Itinerary/cantho.jpg" alt="Discover Can Tho">
            </div>

            <div class="filter-buttons">
                <a href="itinerary.php?slug=all" class="filter-btn <?php echo ($current_slug == 'all') ? 'active' : ''; ?>">ALL TOURS</a>

                <?php if ($all_cats_result->num_rows > 0): ?>
                    <?php while ($nav = $all_cats_result->fetch_assoc()): ?>
                        <a href="itinerary.php?slug=<?php echo $nav['slug']; ?>"
                            class="filter-btn <?php echo ($nav['slug'] == $current_slug) ? 'active' : ''; ?>">
                            <?php echo $nav['menu_name']; ?>
                        </a>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </aside>

        <section class="tour-section">
            <div class="section-header">
                <h2><?php echo $category['section_title']; ?></h2>
                <p><?php echo $category['section_desc']; ?></p>
            </div>

            <div class="tour-grid">
                <?php if ($tours_result->num_rows > 0): ?>
                    <?php while ($tour = $tours_result->fetch_assoc()): ?>

                        <div class="tour-card">
                            <img src="../<?php echo $tour['image_url']; ?>" alt="<?php echo $tour['alt_text']; ?>">
                            <h4><?php echo $tour['tour_name']; ?></h4>
                            <a href="#" class="view-btn" data-target="modal-<?php echo $tour['id']; ?>">View sample tour <i class="fas fa-arrow-right"></i></a>
                        </div>

                        <?php
                        $tour_id = $tour['id'];
                        $itin_query = "SELECT * FROM tour_itineraries WHERE tour_id = $tour_id ORDER BY sort_order ASC";
                        $itin_result = $conn->query($itin_query);
                        ?>
                        <div id="modal-<?php echo $tour['id']; ?>" class="tour-modal-overlay">
                            <div class="tour-modal-content">
                                <button class="close-tour-btn"><i class="fas fa-times"></i></button>

                                <div class="tour-detail-wrapper">
                                    <h3 class="detail-subtitle"><?php echo strtoupper($tour['tour_name']); ?> | SAMPLE TOUR</h3>

                                    <div class="timeline-container">
                                        <?php if ($itin_result->num_rows > 0): ?>
                                            <?php
                                            $current_day = "";
                                            while ($itin = $itin_result->fetch_assoc()):
                                                if ($current_day != $itin['day_label']) {
                                                    $current_day = $itin['day_label'];
                                                    echo '<div class="day-divider"><span>' . $current_day . '</span></div>';
                                                }
                                            ?>
                                                <div class="timeline-item">
                                                    <div class="timeline-image">
                                                        <?php if (!empty($itin['activity_image'])): ?>
                                                            <img src="../<?php echo $itin['activity_image']; ?>" alt="Activity">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="timeline-indicator">
                                                        <div class="timeline-icon">
                                                            <?php
                                                            if ($itin['icon_type'] == 'sunrise') echo '🌅';
                                                            elseif ($itin['icon_type'] == 'sun') echo '☀️';
                                                            elseif ($itin['icon_type'] == 'afternoon') echo '🕓';
                                                            elseif ($itin['icon_type'] == 'moon') echo '🌙';
                                                            else echo '📍';
                                                            ?>
                                                        </div>
                                                        <div class="timeline-line"></div>
                                                    </div>
                                                    <div class="timeline-content">
                                                        <h4><?php echo $itin['time_str'] . ' - ' . $itin['title']; ?></h4>
                                                        <p><?php echo $itin['description']; ?></p>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <p>Itinerary details are currently being updated.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No tours available.</p>
                <?php endif; ?>
            </div>

            <?php if ($total_pages > 1): ?>
                <div class="pagination-container">
                    <?php if ($page > 1): ?>
                        <a href="itinerary.php?slug=<?php echo $current_slug; ?>&page=<?php echo $page - 1; ?>" class="page-btn"><i class="fas fa-chevron-left"></i></a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="itinerary.php?slug=<?php echo $current_slug; ?>&page=<?php echo $i; ?>" class="page-btn <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <a href="itinerary.php?slug=<?php echo $current_slug; ?>&page=<?php echo $page + 1; ?>" class="page-btn"><i class="fas fa-chevron-right"></i></a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </section>
    </main>

    <script>
        const viewButtons = document.querySelectorAll('.view-btn');
        const closeButtons = document.querySelectorAll('.close-tour-btn');

        viewButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-target');
                document.getElementById(targetId).style.display = 'flex';
                document.body.style.overflow = 'hidden'; // Chặn cuộn trang chính khi mở modal
            });
        });

        closeButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('.tour-modal-overlay').style.display = 'none';
                document.body.style.overflow = 'auto';
            });
        });

        window.addEventListener('click', function(e) {
            if (e.target.classList.contains('tour-modal-overlay')) {
                e.target.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    </script>

    <?php
    // Nhúng Footer từ thư mục Footer (Lùi 1 cấp)
    require_once '../Footer/footer.php';
    ?>

    <?php
    if (isset($conn)) {
        $conn->close();
    }
    ?>
</body>

</html>