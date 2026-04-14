<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../includes/db-connect.php");

// ===== TEST DB =====
if (!$conn) {
    die("DB connection failed");
}

// ===== STATS =====
$stats = [];

// destinations
$res = $conn->query("SELECT COUNT(*) as total FROM destinations");
$stats['total_destinations'] = $res ? $res->fetch_assoc()['total'] : 0;

// foods
$res = $conn->query("SELECT COUNT(*) as total FROM foods");
$stats['total_foods'] = $res ? $res->fetch_assoc()['total'] : 0;

// cultures
$res = $conn->query("SELECT COUNT(*) as total FROM cultures");
$stats['total_cultures'] = $res ? $res->fetch_assoc()['total'] : 0;

// pending reviews
$res = $conn->query("SELECT COUNT(*) as total FROM reviews WHERE status = 0");
$stats['pending_reviews'] = $res ? $res->fetch_assoc()['total'] : 0;

// ===== LOGS =====
$logs = [];

$sql = "SELECT al.*, u.fullname as user_name
        FROM activity_logs al
        LEFT JOIN users u ON al.user_id = u.id
        ORDER BY al.created_at DESC
        LIMIT 10";

$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $logs[] = $row;
    }
}

// ===== LOAD HEADER SAFE =====
if (file_exists(__DIR__ . "/layouts/header.php")) {
    require_once __DIR__ . "/layouts/header.php";
} else {
    echo "<h2>Header not found</h2>";
}
?>

<h2>Dashboard</h2>

<div class="stats-grid">
    <div>Destinations: <?= $stats['total_destinations'] ?></div>
    <div>Foods: <?= $stats['total_foods'] ?></div>
    <div>Cultures: <?= $stats['total_cultures'] ?></div>
    <div>Reviews: <?= $stats['pending_reviews'] ?></div>
</div>

<h3>Recent Activity</h3>

<table border="1">
    <tr>
        <th>Time</th>
        <th>User</th>
        <th>Action</th>
        <th>Module</th>
    </tr>

    <?php foreach ($logs as $log): ?>
        <tr>
            <td><?= date('H:i d/m/Y', strtotime($log['created_at'])) ?></td>
            <td><?= htmlspecialchars($log['user_name'] ?? 'System') ?></td>
            <td><?= $log['action'] ?></td>
            <td><?= $log['subject_type'] ?> #<?= $log['subject_id'] ?></td>
        </tr>
    <?php endforeach; ?>

</table>