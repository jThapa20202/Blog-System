<?php
require_once "../config/db.php";

// Get query
$q = trim($_GET['q'] ?? '');
if(!$q){
    echo json_encode([]);
    exit;
}

// Search in title, content, category, or year
$stmt = $pdo->prepare("
    SELECT posts.id, posts.title, categories.name AS category, posts.created_at
    FROM posts
    LEFT JOIN categories ON posts.category_id = categories.id
    WHERE posts.title LIKE ? 
       OR posts.content LIKE ?
       OR categories.name LIKE ?
       OR YEAR(posts.created_at) LIKE ?
    ORDER BY posts.created_at DESC
    LIMIT 10
");

$like = "%$q%";
$stmt->execute([$like, $like, $like, $like]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return JSON
header('Content-Type: application/json');
echo json_encode($results);
