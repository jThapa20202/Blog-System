<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

require_once "../config/db.php";
require_once "../includes/functions.php"; 

$csrf_token = generateCSRFToken();

$id = $_GET['id'] ?? null;
if(!$id) die("No post ID specified.");

// Fetch post
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();
if(!$post) die("Post not found.");

// Fetch categories
$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(!verifyCSRFToken($_POST['csrf_token'] ?? '')){
        die("❌ CSRF validation failed!");
    }

    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $category_id = $_POST['category_id'] ?? null;

    if($title && $content && $category_id){
        $stmt = $pdo->prepare(
            "UPDATE posts SET title = ?, content = ?, category_id = ? WHERE id = ?"
        );
        $stmt->execute([$title, $content, $category_id, $id]);

        $message = "Post updated successfully!";
    } else {
        $message = "Please fill all fields.";
    }
}
?>

<?php include "../includes/header.php"; ?>

<h2>Edit Post</h2>

<?php if($message): ?>
    <p style="color: <?= strpos($message,'✅')!==false ? 'green' : 'red'; ?>;">
        <?= htmlspecialchars($message) ?>
    </p>
<?php endif; ?>

<form method="post">
    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

    <label>Title:</label><br>
    <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br><br>

    <label>Content:</label><br>
    <textarea name="content" rows="5" required><?= htmlspecialchars($post['content']) ?></textarea><br><br>

    <label>Category:</label><br>
    <select name="category_id" required>
        <?php foreach($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= $cat['id']==$post['category_id'] ? 'selected':'' ?>>
                <?= htmlspecialchars($cat['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Update Post</button>
</form>

<?php include "../includes/footer.php"; ?>
