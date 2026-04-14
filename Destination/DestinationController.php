<?php

class DestinationController
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../includes/db-connect.php';
        $this->conn = $conn;
    }

    public function index()
    {
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $categorySlug = isset($_GET['category']) ? trim($_GET['category']) : '';
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'recommended';

        $page = isset($_GET['page']) && is_numeric($_GET['page'])
            ? (int) $_GET['page']
            : 1;

        $limit = 6;
        $offset = ($page - 1) * $limit;

        // ================= CATEGORIES =================
        $categories = [];
        $result = mysqli_query($this->conn, "SELECT * FROM destination_categories");

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $categories[] = $row;
            }
        }

        // ================= CATEGORY FILTER =================
        $categoryId = null;

        if ($categorySlug) {
            $stmt = mysqli_prepare(
                $this->conn,
                "SELECT id FROM destination_categories WHERE slug = ?"
            );

            mysqli_stmt_bind_param($stmt, "s", $categorySlug);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);

            $category = mysqli_fetch_assoc($res);
            if ($category) {
                $categoryId = $category['id'];
            }
        }

        // ================= WHERE =================
        $where = ["d.status = 1"];

        if ($search) {
            $searchSafe = mysqli_real_escape_string($this->conn, $search);
            $where[] = "d.name LIKE '%$searchSafe%'";
        }

        if ($categoryId) {
            $where[] = "d.destination_category_id = " . (int)$categoryId;
        }

        $whereSql = "WHERE " . implode(" AND ", $where);

        // ================= SORT =================
        $orderBy = "d.created_at DESC";

        if ($sort === 'rating') {
            $orderBy = "reviews_avg_rating DESC";
        } elseif ($sort === 'az') {
            $orderBy = "d.name ASC";
        }

        // ================= COUNT =================
        $countSql = "SELECT COUNT(*) as total FROM destinations d $whereSql";
        $countResult = mysqli_query($this->conn, $countSql);
        $countRow = mysqli_fetch_assoc($countResult);

        $total = $countRow['total'] ?? 0;
        $totalPages = ceil($total / $limit);

        // ================= MAIN QUERY =================
        $sql = "
            SELECT d.*, 
                   c.name as category_name,
                   c.slug as category_slug,
                   i.image as primary_image,
                   (
                       SELECT COUNT(*) 
                       FROM reviews r 
                       WHERE r.destination_id = d.id 
                       AND r.status = 1
                   ) as reviews_count,
                   (
                       SELECT AVG(rating) 
                       FROM reviews r 
                       WHERE r.destination_id = d.id 
                       AND r.status = 1
                   ) as reviews_avg_rating
            FROM destinations d
            LEFT JOIN destination_categories c 
                ON d.destination_category_id = c.id
            LEFT JOIN destination_images i 
                ON d.id = i.destination_id 
                AND i.is_primary = 1
            $whereSql
            ORDER BY $orderBy
            LIMIT $limit OFFSET $offset
        ";

        $destinations = [];
        $result = mysqli_query($this->conn, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $destinations[] = $row;
            }
        }

        require __DIR__ . '/index.php';
    }

    public function show($slug)
    {
        $slugSafe = mysqli_real_escape_string($this->conn, $slug);

        // ================= DESTINATION =================
        $sql = "
            SELECT d.*, 
                   c.name as category_name,
                   (
                       SELECT COUNT(*) 
                       FROM reviews r 
                       WHERE r.destination_id = d.id 
                       AND r.status = 1
                   ) as reviews_count,
                   (
                       SELECT AVG(rating) 
                       FROM reviews r 
                       WHERE r.destination_id = d.id 
                       AND r.status = 1
                   ) as reviews_avg_rating
            FROM destinations d
            LEFT JOIN destination_categories c 
                ON d.destination_category_id = c.id
            WHERE d.slug = '$slugSafe' 
            AND d.status = 1
        ";

        $result = mysqli_query($this->conn, $sql);
        $destination = mysqli_fetch_assoc($result);

        if (!$destination) {
            http_response_code(404);
            echo "404 Not Found";
            exit;
        }

        // ================= IMAGES =================
        $images = [];
        $imgResult = mysqli_query(
            $this->conn,
            "SELECT * FROM destination_images WHERE destination_id = " . (int)$destination['id']
        );

        if ($imgResult) {
            while ($row = mysqli_fetch_assoc($imgResult)) {
                $images[] = $row;
            }
        }

        // ================= REVIEWS =================
        $reviews = [];
        $reviewResult = mysqli_query(
            $this->conn,
            "SELECT * FROM reviews 
             WHERE destination_id = " . (int)$destination['id'] . " 
             AND status = 1 
             ORDER BY created_at DESC"
        );

        if ($reviewResult) {
            while ($row = mysqli_fetch_assoc($reviewResult)) {
                $reviews[] = $row;
            }
        }

        require __DIR__ . '/show.php';
    }
}
