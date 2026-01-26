<?php
require_once "../config/db.php";

// Only accept POST requests
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    exit;
}

// Get POST data
$post_id = intval($_POST['post_id'] ?? 0);
$author = trim($_POST['author'] ?? '');
$comment_text = trim($_POST['comment_text'] ?? '');

if(!$post_id || !$author || !$comment_text){
    echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
    exit;
}

// Insert comment
$stmt = $pdo->prepare("INSERT INTO comments (post_id, author, comment_text) VALUES (?, ?, ?)");
$stmt->execute([$post_id, $author, $comment_text]);

// Return the new comment
echo json_encode([
    'status' => 'success',
    'comment' => [
        'author' => htmlspecialchars($author),
        'comment_text' => htmlspecialchars($comment_text),
        'created_at' => date('Y-m-d H:i:s')
    ]
]);
