<?php
// includes/db.php
$host = 'localhost';
$dbname = 'login_system';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysqli:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}