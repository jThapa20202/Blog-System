<?php
require_once "../config/db.php";

// Fetch all posts with category
$posts = $pdo->query("
    SELECT posts.id, posts.title, posts.content, categories.name AS category, posts.created_at
    FROM posts
    LEFT JOIN categories ON posts.category_id = categories.id
    ORDER BY posts.created_at DESC
")->fetchAll();
?>

<?php include "../includes/header.php"; ?>

<!-- Hero Section -->
<section class="hero">
    <h1>Welcome to My Blog 💗</h1>
    <p>Soft thoughts, simple stories & student life </p>
</section>

<!-- Search -->
<div class="container">
    <div class="card">
        <div class="search-container">
            <input type="text" id="search-input" placeholder="Search posts by title, category, or year...">
            <div id="search-results" class="autocomplete-results"></div>
        </div>
    </div>

    <!-- Latest Posts -->
    <h2>Latest Posts</h2>

    <?php foreach($posts as $post): ?>
        <div class="card post-card">
            <h3><?= htmlspecialchars($post['title']) ?></h3>
            <p class="post-meta">
                Category: <?= htmlspecialchars($post['category'] ?? 'Uncategorized') ?> | <?= $post['created_at'] ?>
            </p>
            <p class="excerpt">
                <?= nl2br(htmlspecialchars(substr($post['content'],0,200))) ?>...
            </p>
            <a class="read-more" href="post.php?id=<?= $post['id'] ?>">Read More</a>
        </div>
    <?php endforeach; ?>

    <p>------------------------------------------------🌺🌺🌺🌺🌺🌺🌺🌺🌺🌺🌺🌺🌺🌺🌺🌺🌺🌺🌺-------------------------------------------------</p>
    <div class="card">
        <h3>About Me </h3>
        <p>This blog is part of my coursework project. Sharing thoughts & learning every day!</p>
    </div>

</div> <!-- end container -->

<?php include "../includes/footer.php"; ?>
