<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Use environment variables for live production, fallback to local XAMPP defaults
$host = getenv('DB_HOST') !== false ? getenv('DB_HOST') : "127.0.0.1";
$user = getenv('DB_USER') !== false ? getenv('DB_USER') : "root";
$pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : "";
$db   = getenv('DB_NAME') !== false ? getenv('DB_NAME') : "kitchencart_db";
$port = getenv('DB_PORT') !== false ? getenv('DB_PORT') : 3306;

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>