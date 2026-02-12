<?php
// Database configuration
$host = 'localhost';
$dbname = 'tours_booking';
$user = 'root';
$pass = '';

// Create a PDO instance
try {
    $dsn = "mysql:host={$host};dbname={$dbname};charset=UTF8";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
