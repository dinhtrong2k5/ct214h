<?php
if (!isset($destinations)) {
    require_once __DIR__ . '/DestinationController.php';
    $controller = new DestinationController();
    $controller->index();
    exit();
}

$pageTitle = 'Destinations - Discover Can Tho';
require_once '../Header/header.php';
?>

<!-- CSS riêng cho Destination -->
<link rel="stylesheet" href="../css/Destination/destination.css">

<section class="banner">
    <div class="banner-overlay"></div>
    <div class="banner-content">
        <h1 class="banner-title">Destinations</h1>
    </div>
</section>

<section class="container section-padding">

    <form action="index.php" method="GET" class="search-form">
        <i class="fas fa-search search-icon"></i>
        <input type="text"
            name="search"
            value="<?= htmlspecialchars($search ?? '') ?>"
            placeholder="Search for places to go..."
            class="search-input">
        <button type="submit" class="btn-search">Search</button>
    </form>

    <div class="filter-bar">
        <div class="category-tags">
            <a href="index.php" class="tag <?= empty($categorySlug) ? 'active' : '' ?>">
                All Places
            </a>

            <?php foreach (($categories ?? []) as $category): ?>
                <a href="index.php?category=<?= htmlspecialchars($category['slug']) ?><?= !empty($search) ? '&search=' . urlencode($search) : '' ?>"
                    class="tag <?= (($categorySlug ?? '') === $category['slug']) ? 'active' : '' ?>">
                    <?= htmlspecialchars($category['name']) ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="sort-box">
            <span>Sort by:</span>
            <form action="index.php" method="GET" id="sortForm">
                <?php if (!empty($categorySlug)): ?>
                    <input type="hidden" name="category" value="<?= htmlspecialchars($categorySlug) ?>">
                <?php endif; ?>

                <?php if (!empty($search)): ?>
                    <input type="hidden" name="search" value="<?= htmlspecialchars($search) ?>">
                <?php endif; ?>

                <select name="sort"
                    onchange="document.getElementById('sortForm').submit()"
                    class="sort-select">
                    <option value="newest" <?= (($sort ?? '') == 'newest') ? 'selected' : '' ?>>
                        Latest Updates
                    </option>
                    <option value="az" <?= (($sort ?? '') == 'az') ? 'selected' : '' ?>>
                        Name (A-Z)
                    </option>
                </select>
            </form>
        </div>
    </div>

    <div class="destination-grid">
        <?php if (empty($destinations)): ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 50px 0;">
                <i class="fa-solid fa-map-location-dot"
                    style="font-size: 3rem; color: #9ca3af; margin-bottom: 15px;"></i>
                <h3>No destinations found</h3>
                <a href="index.php"
                    style="color: var(--primary-color); text-decoration: underline;">
                    Clear all filters
                </a>
            </div>
        <?php else: ?>
            <?php foreach ($destinations as $item): ?>
                <?php
                $imgUrl = '../images/Destinations/default.jpg';

                if (
                    !empty($item['primary_image']) &&
                    file_exists('../images/Destinations/' . $item['primary_image'])
                ) {
                    $imgUrl = '../images/Destinations/' . $item['primary_image'];
                }
                ?>

                <div class="card">
                    <div class="card-img-box">
                        <img src="<?= $imgUrl ?>"
                            alt="<?= htmlspecialchars($item['name']) ?>"
                            class="card-img">

                        <span class="card-badge">
                            <?= htmlspecialchars($item['category_name'] ?? 'Destination') ?>
                        </span>
                    </div>

                    <div class="card-body">
                        <h3 class="card-title">
                            <?= htmlspecialchars($item['name']) ?>
                        </h3>

                        <p class="card-desc">
                            <?= htmlspecialchars($item['description']) ?>
                        </p>

                        <div class="card-info">
                            <div class="info-item">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>
                                    <?= htmlspecialchars($item['address'] ?? 'Can Tho City') ?>
                                </span>
                            </div>

                            <div class="info-item">
                                <i class="fa-solid fa-ticket"></i>
                                <span>
                                    <?= ($item['ticket_price'] > 0)
                                        ? number_format($item['ticket_price'], 0, ',', '.') . ' VND'
                                        : 'Free Entry' ?>
                                </span>
                            </div>
                        </div>

                        <a href="show.php?slug=<?= htmlspecialchars($item['slug']) ?>"
                            class="btn-outline">
                            View Details
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php if (!empty($totalPages) && $totalPages > 1): ?>
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="index.php?page=<?= $i ?>"
                    class="page-link <?= (($page ?? 1) == $i) ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>

</section>

<?php require_once '../Footer/footer.php'; ?>