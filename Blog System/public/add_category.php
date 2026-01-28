<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

require_once "../config/db.php";
require_once "../includes/functions.php"; // ✅ REQUIRED

$csrf_token = generateCSRFToken();
$message = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    // ✅ CSRF check
    if(!verifyCSRFToken($_POST['csrf_token'] ?? '')){
        die("❌ CSRF validation failed!");
    }

    $name = trim($_POST['name'] ?? '');

    if($name){
        $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->execute([$name]);
        $message = "Category added successfully!";
    } else {
        $message = "Please enter a category name.";
    }
}
?>

<?php include "../includes/header.php"; ?>

<h2>Add Category</h2>

<?php if($message): ?>
    <p style="color: <?= strpos($message,'✅')!==false ? 'green':'red'; ?>;">
        <?= htmlspecialchars($message) ?>
    </p>
<?php endif; ?>

<form method="post">
    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">

    <label>Category Name:</label><br>
    <input type="text" name="name" required><br><br>

    <button type="submit">Add Category</button>
</form>

<?php include "../includes/footer.php"; ?>
