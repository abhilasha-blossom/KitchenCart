<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Use environment variables for live production, fallback to local XAMPP defaults
$host = getenv('DB_HOST') !== false ? getenv('DB_HOST') : "sql308.infinityfree.com";
$user = getenv('DB_USER') !== false ? getenv('DB_USER') : "if0_41558960";
$pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : "9359214074Abhi";
$db   = getenv('DB_NAME') !== false ? getenv('DB_NAME') : "if0_41558960_kitchencart";
$port = getenv('DB_PORT') !== false ? getenv('DB_PORT') : 3306;

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>