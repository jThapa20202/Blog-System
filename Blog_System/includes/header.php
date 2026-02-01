<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog System </title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <nav>
        <div class="logo" style="color:white; font-size:24px; font-weight:bold;">Blog System </div>
        <div class="nav-links">
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="dashboard.php">Dashboard</a>
                <a href="add_post.php">Add Post</a>
                <a href="manage_posts.php">Manage Posts</a>
                <a href="add_category.php">Add Category</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<main class="container">
