<?php
// KIỂM TRA DỮ LIỆU ĐẦU VÀO
if (!isset($destination)) {
    require_once __DIR__ . '/DestinationController.php';
    $controller = new DestinationController();

    $slug = isset($_GET['slug']) ? $_GET['slug'] : '';

    if (!empty($slug)) {
        $controller->show($slug);
    } else {
        echo "Destination not found";
    }
    exit();
}

$pageTitle = $destination['name'] . ' - Discover Can Tho';
require_once '../Header/header.php';

$primaryImage = null;
$galleryImages = [];

if (!empty($images)) {
    foreach ($images as $img) {
        if ($img['is_primary'] == 1 && !$primaryImage) {
            $primaryImage = $img;
        } elseif ($img['is_primary'] == 0 && count($galleryImages) < 2) {
            $galleryImages[] = $img;
        }
    }
}
?>

<link rel="stylesheet" href="../css/Destination/destination.css">

<section class="detail-banner"
    <?php if ($primaryImage && file_exists('../images/Destinations/' . $primaryImage['image'])): ?>
    style="background-image: url('../images/Destinations/<?= htmlspecialchars($primaryImage['image']) ?>');"
    <?php endif; ?>>

    <?php if (!$primaryImage || !file_exists('../images/Destinations/' . $primaryImage['image'])): ?>
        <div class="banner-placeholder">
            <i class="fa-regular fa-image"></i>
        </div>
    <?php endif; ?>

    <div class="banner-gradient"></div>

    <div class="banner-content">
        <div class="container">
            <nav class="breadcrumb">
                <a href="../Homepage/index.php">Home</a> <span>/</span>
                <a href="index.php">Destinations</a> <span>/</span>
                <span class="active"><?= htmlspecialchars($destination['name']) ?></span>
            </nav>

            <h1 class="banner-title"><?= htmlspecialchars($destination['name']) ?></h1>

            <div class="banner-meta">
                <span class="badge">
                    <?= htmlspecialchars($destination['category_name'] ?? 'Uncategorized') ?>
                </span>
                <div class="rating">
                    <i class="fas fa-star"></i>
                    <span>
                        <?= number_format($destination['reviews_avg_rating'] ?? 0, 1) ?>
                        (<?= number_format($destination['reviews_count'] ?? 0) ?> Reviews)
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="detail-section container">
    <div class="detail-layout">

        <div class="detail-main">
            <div class="about-box">
                <h2 class="section-title">About this destination</h2>
                <div class="detail-description">
                    <?= nl2br(htmlspecialchars($destination['description'] ?? '')) ?>
                </div>
            </div>

            <?php if (count($galleryImages) > 0): ?>
                <div class="gallery-grid">
                    <?php foreach ($galleryImages as $img): ?>
                        <div class="gallery-item">
                            <img src="../images/Destinations/<?= htmlspecialchars($img['image']) ?>" alt="Gallery Image">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="reviews-wrapper">
                <h3 class="section-title">Reviews</h3>
                <div class="review-list">
                    <?php if (empty($reviews)): ?>
                        <p class="no-data">No reviews yet. Be the first to share your experience!</p>
                    <?php else: ?>
                        <?php foreach ($reviews as $review): ?>
                            <div class="review-card">
                                <div class="review-header">
                                    <div>
                                        <h4 class="reviewer-name"><?= htmlspecialchars($review['name']) ?></h4>
                                        <p class="review-date"><?= date('M d, Y', strtotime($review['created_at'])) ?></p>
                                    </div>
                                    <div class="review-stars">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="<?= $i <= $review['rating'] ? 'fas' : 'far' ?> fa-star"></i>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <p class="review-comment"><?= nl2br(htmlspecialchars($review['comment'])) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="detail-sidebar">
            <div class="sidebar-box">
                <h3 class="sidebar-title">Plan Your Visit</h3>

                <div class="info-list">
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt info-icon"></i>
                        <div class="info-content">
                            <p class="info-label">Location</p>
                            <p class="info-text"><?= htmlspecialchars($destination['address'] ?? '') ?></p>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="far fa-clock info-icon"></i>
                        <div class="info-content">
                            <p class="info-label">Operating Hours</p>
                            <p class="info-text">
                                <?php if (!empty($destination['opening_hour']) && !empty($destination['closing_hour'])): ?>
                                    <?= date('h:i A', strtotime($destination['opening_hour'])) ?>
                                    -
                                    <?= date('h:i A', strtotime($destination['closing_hour'])) ?>
                                <?php else: ?>
                                    Open Daily
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fas fa-ticket-alt info-icon"></i>
                        <div class="info-content">
                            <p class="info-label">Entrance Fee</p>
                            <p class="info-text">
                                <?= (isset($destination['ticket_price']) && $destination['ticket_price'] > 0)
                                    ? number_format($destination['ticket_price'], 0, ',', '.') . ' VND'
                                    : 'Free Entry' ?>
                            </p>
                        </div>
                    </div>
                </div>

                <a href="https://www.google.com/maps/search/<?= urlencode($destination['name'] . ' ' . ($destination['address'] ?? '')) ?>"
                    target="_blank"
                    class="btn-direction">
                    <i class="fas fa-directions"></i> Get Directions
                </a>
            </div>
        </div>

    </div>
</section>

<?php require_once '../Footer/footer.php'; ?>