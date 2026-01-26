<?php
require_once "../config/db.php";

// Get post ID from URL
if(!isset($_GET['id']) || empty($_GET['id'])){
    die("Post not found.");
}

$post_id = intval($_GET['id']);

// Fetch post
$stmt = $pdo->prepare("
    SELECT posts.*, categories.name AS category 
    FROM posts 
    LEFT JOIN categories ON posts.category_id = categories.id 
    WHERE posts.id = ?
");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

if(!$post){
    die("Post not found.");
}

// Fetch comments
$comments = $pdo->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC");
$comments->execute([$post_id]);
$comments = $comments->fetchAll();
?>

<?php include "../includes/header.php"; ?>

<div class="post-card">
    <h2><?= htmlspecialchars($post['title']) ?></h2>
    <p><em>Category: <?= htmlspecialchars($post['category'] ?? 'Uncategorized') ?> | Posted on <?= $post['created_at'] ?></em></p>
    <div class="post-content">
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </div>
</div>

<hr>

<h3>Comments</h3>
<div class="comments-section">
    <?php if($comments): ?>
        <?php foreach($comments as $c): ?>
            <div class="comment">
                <strong><?= htmlspecialchars($c['author']) ?>:</strong>
                <p><?= htmlspecialchars($c['comment_text']) ?></p>
                <small><?= $c['created_at'] ?></small>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-comments">No comments yet</p>
    <?php endif; ?>
</div>

<hr>

<!-- Comment Form -->
<div class="comment-form">
    <h4>Leave a Comment</h4>
    <form id="comment-form">
        <input type="hidden" name="post_id" value="<?= $post_id ?>">
        <input type="text" name="author" placeholder="Your name" required>
        <textarea name="comment_text" placeholder="Your comment" required></textarea>
        <button type="submit" class="btn btn-primary">Post Comment</button>
    </form>
</div>


<?php include "../includes/footer.php"; ?>
