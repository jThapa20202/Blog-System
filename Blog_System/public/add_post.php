<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

require_once "../config/db.php";
require_once "../includes/functions.php";
$csrf_token = generateCSRFToken();

$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     if(!verifyCSRFToken($_POST['csrf_token'] ?? '')){
        die("❌ CSRF validation failed!");
    }
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $category_id = $_POST['category_id'] ?? null;

    if ($title && $content && $category_id) {
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, category_id) VALUES (?, ?, ?)");
        $stmt->execute([$title, $content, $category_id]);

        $message = "✅ Post added successfully!";
    } else {
        $message = "❌ Please fill all fields.";
    }
}

// Fetch categories for dropdown
$categories = $pdo->query("SELECT * FROM categories ORDER BY name")->fetchAll();
?>

<?php include "../includes/header.php"; ?>

<section class="hero">
    <h1>Add a New Post 🌸</h1>
    <p>Share your thoughts and stories with your readers 💕</p>
</section>

<div class="container">

    <!-- Message -->
    <?php if($message): ?>
        <div class="card">
            <p style="color: <?= strpos($message,'✅')!==false ? 'green' : 'red'; ?>;">
                <?= htmlspecialchars($message) ?>
            </p>
        </div>
    <?php endif; ?>

    <!-- Form -->
    <div class="card">
        <form method="post">
            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

            <label>Title:</label>
            <input type="text" name="title" required>

            <label>Content:</label>
            <textarea name="content" rows="5" required></textarea>

            <label>Category:</label>
            <select name="category_id" required>
                <option value="">-- Select Category --</option>
                <?php foreach($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Add Post 💕</button>
        </form>
    </div>

</div> <!-- end container -->

<?php include "../includes/footer.php"; ?>
