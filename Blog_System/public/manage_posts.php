<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

require_once "../config/db.php";

// Fetch all posts with category name
$stmt = $pdo->query("
    SELECT posts.id, posts.title, posts.created_at, categories.name AS category
    FROM posts
    LEFT JOIN categories ON posts.category_id = categories.id
    ORDER BY posts.created_at DESC
");
$posts = $stmt->fetchAll();
?>

<?php include "../includes/header.php"; ?>

<section class="hero">
    <h1>Manage Your Posts 🌸</h1>
    <p>View, edit, or delete posts with ease 💕</p>
</section>

<div class="container">

    <?php if(empty($posts)): ?>
        <div class="card">
            <p>No posts found. Start by <a href="add_post.php">adding a new post 💖</a></p>
        </div>
    <?php endif; ?>

    <?php foreach($posts as $post): ?>
        <div class="card">
            <h3><?= htmlspecialchars($post['title']) ?></h3>
            <p class="post-meta">
                Category: <?= htmlspecialchars($post['category'] ?? 'Uncategorized') ?> | Created: <?= $post['created_at'] ?>
            </p>

           <div class="post-actions">
            <a href="edit_post.php?id=<?= $post['id'] ?>" class="btn btn-edit">Edit</a>

            <form method="post"
                action="delete_post.php"
                onsubmit="return confirm('Are you sure you want to delete this post?');">
                <input type="hidden" name="id" value="<?= $post['id'] ?>">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <button type="submit" class="btn btn-delete">Delete</button>
            </form>
        </div>

        </div>
    <?php endforeach; ?>

</div> 

<?php include "../includes/footer.php"; ?>
