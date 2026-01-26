<?php
require_once "../config/db.php"; // connect to database

$username = "admin";      // your admin username
$plainPassword = "admin123"; // admin password

$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $hashedPassword]);
    echo "✅ Admin user created successfully!";
} catch(PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
