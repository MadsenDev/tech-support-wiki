<?php

$host = 'localhost';
$dbname = 'madsyrnh_wiki';
$username = 'madsyrnh_chris';
$password = 'data2023';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Set the PDO error mode to exception to catch any errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Uncomment below line to confirm connection is successful, then comment it out again
    // echo "Connected successfully";
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}