<style>
    .sidebar {
        width: 240px;
        height: 100vh;
        background: #0f172a;
        position: fixed;
        color: white;
    }

    .sidebar h2 {
        text-align: center;
        padding: 20px;
    }

    .sidebar a {
        display: block;
        padding: 12px 20px;
        color: #cbd5f5;
        text-decoration: none;
    }

    .sidebar a:hover {
        background: #1e293b;
    }
</style>

<div class="sidebar">
    <h2>ADMIN</h2>

    <a href="/admin/dashboard.php">Dashboard</a>
    <a href="/admin/food/list.php">Food</a>
    <a href="/admin/culture/list.php">Culture</a>
    <a href="/admin/destination/list.php">Destination</a>
    <a href="/admin/itinerary/list.php">Itinerary</a>

    <a href="/admin/logout.php">Logout</a>
</div>