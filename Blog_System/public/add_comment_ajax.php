<?php
require_once "../config/db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

$post_id = intval($_POST['post_id'] ?? 0);
$author = trim($_POST['author'] ?? '');
$comment_text = trim($_POST['comment_text'] ?? '');

if (!$post_id || !$author || !$comment_text) {
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO comments (post_id, author, comment_text) VALUES (?, ?, ?)"
);
$stmt->execute([$post_id, $author, $comment_text]);

$initial = strtoupper(substr($author, 0, 1));
$time = date('Y-m-d H:i:s');
?>

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

    <!-- Profile -->
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
        <?= $initial ?>
    </div>

    <!-- CONTENT -->
    <div style="flex:1;">
        <div style="display:flex; justify-content:space-between; margin-bottom:6px;">
            <strong><?= htmlspecialchars($author) ?></strong>
            <small style="color:#777; font-size:12px;">
                <?= $time ?>
            </small>
        </div>

        <p style="margin:0; line-height:1.6;">
            <?= htmlspecialchars($comment_text) ?>
        </p>
    </div>

</div>
