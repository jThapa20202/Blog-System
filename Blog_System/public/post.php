<?php
require_once "../config/db.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Post not found.");
}

$post_id = intval($_GET['id']);

/* ================= FETCH POST ================= */

$stmt = $pdo->prepare("
    SELECT posts.*, categories.name AS category
    FROM posts
    LEFT JOIN categories ON posts.category_id = categories.id
    WHERE posts.id = ?
");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

if (!$post) {
    die("Post not found.");
}

/* ================= FETCH COMMENTS ================= */

$stmt = $pdo->prepare(
    "SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC"
);
$stmt->execute([$post_id]);
$comments = $stmt->fetchAll();
?>

<?php include "../includes/header.php"; ?>

<!-- ================= POST ================= -->

<div class="post-card">
    <h2><?= htmlspecialchars($post['title']) ?></h2>

    <p class="post-meta">
        Category: <?= htmlspecialchars($post['category'] ?? 'Uncategorized') ?>
        | Posted on <?= $post['created_at'] ?>
    </p>

    <div class="post-content">
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </div>
</div>

<!-- ================= COMMENT FORM ================= -->

<div class="comment-form">
    <h4>Leave a Feedback</h4>

    <form id="comment-form">
        <input type="hidden" name="post_id" value="<?= $post_id ?>">

        <input type="text" name="author" placeholder="Your name" required>
        <textarea name="comment_text" placeholder="Your comment" required></textarea>

        <button type="submit" class="btn btn-primary">Post Feedback</button>
    </form>
</div>

<hr>

<!-- ================= COMMENTS ================= -->

<h3>User Feedback</h3>

<div class="comments-section">

<?php if ($comments): ?>
    <?php foreach ($comments as $c): ?>
        <div style="
            background:#ffffff;
            padding:15px;
            margin-bottom:15px;
            border-radius:8px;
            border:1px solid #e0e0e0;
            box-shadow:0 2px 4px rgba(0,0,0,0.05);
            display:flex;
            gap:12px;
        ">

            <!-- AVATAR -->
            <div style="
                width:40px;
                height:40px;
                border-radius:50%;
                background:linear-gradient(135deg, #b892e6, #f3a6c8);
                color:#fff;
                display:flex;
                align-items:center;
                justify-content:center;
                font-weight:bold;
                text-transform:uppercase;
                flex-shrink:0;
            ">
                <?= strtoupper(substr($c['author'], 0, 1)) ?>
            </div>

            <!-- COMMENT CONTENT -->
            <div style="flex:1;">
                <div style="display:flex; justify-content:space-between; margin-bottom:6px;">
                    <strong><?= htmlspecialchars($c['author']) ?></strong>
                    <small style="color:#777; font-size:12px;">
                        <?= $c['created_at'] ?>
                    </small>
                </div>

                <p style="margin:0; line-height:1.6;">
                    <?= htmlspecialchars($c['comment_text']) ?>
                </p>
            </div>

        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p class="no-comments" style="color:#777;">No feedback yet</p>
<?php endif; ?>

</div>

<!-- ================= AJAX SCRIPT ================= -->

<script>
document.addEventListener('DOMContentLoaded', () => {

    const commentForm = document.getElementById('comment-form');
    const commentsSection = document.querySelector('.comments-section');

    if (!commentForm || !commentsSection) return;

    commentForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(commentForm);

        fetch('../public/add_comment_ajax.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.text()) // important: returns HTML
        .then(html => {

            // Remove "no comments" text if present
            const noComments = commentsSection.querySelector('.no-comments');
            if (noComments) noComments.remove();

            // Insert new comment at the top
            commentsSection.insertAdjacentHTML('afterbegin', html);
            commentForm.reset();
        })
        .catch(() => alert('Something went wrong. Please try again.'));
    });

});
</script>

<?php include "../includes/footer.php"; ?>
