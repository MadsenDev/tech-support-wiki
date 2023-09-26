<?php
// api/db.php
$host = 'localhost';
$db_name = '';
$username = '';
$password = '';

try {
    $db = new PDO("mysql:host={$host};dbname={$db_name};charset=utf8mb4", $username, $password);
} catch (PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
}
?>