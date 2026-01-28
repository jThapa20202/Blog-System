<?php
session_start();
require_once "../config/db.php"; // connect to database

$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username && $password) {
        // Fetch user from database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php"); 
            exit;
        } else {
            $message = "Invalid username or password.";
        }
    } else {
        $message = "Please enter both username and password.";
    }
}
?>

<?php include "../includes/header.php"; ?>


<h2>Admin Login</h2>

<?php if($message): ?>
    <p style="color:red;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="post">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<?php include "../includes/footer.php"; ?>
