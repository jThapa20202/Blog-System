<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

require_once "../config/db.php";
require_once "../includes/functions.php";

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    die("Invalid request.");
}

if(!verifyCSRFToken($_POST['csrf_token'] ?? '')){
    die("CSRF validation failed!");
}

$id = $_POST['id'] ?? null;
if(!$id){
    die("No post ID specified.");
}

$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
$stmt->execute([$id]);

header("Location: manage_posts.php");
exit;
