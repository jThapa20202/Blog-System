<?php
// $servername = "localhost";               
// $dbname = "np02cs4a240089";         
// $user = "root";           
// $password = "";    

$servername = "localhost";               
$dbname = "np02cs4a240089";         
$user = "np02cs4a240089";           
$password = "LzGEqFl4Ua";  

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

  