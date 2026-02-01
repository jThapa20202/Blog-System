<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

require_once "../config/db.php";

// --- Dashboard Stats ---
$totalPosts = $pdo->query("SELECT COUNT(*) FROM posts")->fetchColumn();
$totalCategories = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
$totalComments = $pdo->query("SELECT COUNT(*) FROM comments")->fetchColumn();

// --- Recent Posts ---
$recentPosts = $pdo->query("
    SELECT posts.id, posts.title, categories.name AS category, posts.created_at
    FROM posts
    LEFT JOIN categories ON posts.category_id = categories.id
    ORDER BY posts.created_at DESC
    LIMIT 5
")->fetchAll();

?>

<?php include "../includes/header.php"; ?>



<h2>Welcome to Dashboard! Feel free to share your thoughts</h2>

<!-- Dashboard Buttons -->
<div class="dashboard-buttons">
    <a class="btn btn-primary" href="add_post.php">Add Post</a>
    <a class="btn btn-primary" href="manage_posts.php">Manage Posts</a>
    <a class="btn btn-primary" href="add_category.php">Add Category</a>
    <a class="btn btn-secondary" href="logout.php">Logout</a>
</div>

<!-- Dashboard Stats -->
<div class="dashboard-stats">
    <div class="stat-card">Total Posts: <?= $totalPosts ?></div>
    <div class="stat-card">Total Categories: <?= $totalCategories ?></div>
    <div class="stat-card">Total Feedbacks: <?= $totalComments ?></div>
</div>

<!-- Recent Posts Cards -->
<h3>Recent Posts</h3>
<div class="dashboard-posts">
    <?php foreach($recentPosts as $post): ?>
        <div class="dashboard-card">
            <h4><?= htmlspecialchars($post['title']) ?></h4>
            <p><em><?= htmlspecialchars($post['category'] ?? 'Uncategorized') ?> | <?= $post['created_at'] ?></em></p>
            <div class="card-actions">
                <a class="btn btn-edit" href="edit_post.php?id=<?= $post['id'] ?>">Edit</a>
                <a class="btn btn-delete" href="delete_post.php?id=<?= $post['id'] ?>" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include "../includes/footer.php"; ?>
