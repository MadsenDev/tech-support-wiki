<?php
// api/users/read.php

// Include database connection
include_once '../db.php';

// Prepare SQL query
$query = "SELECT * FROM users";
$stmt = $db->prepare($query);

// Execute query
$stmt->execute();

// Fetch results
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output JSON
echo json_encode($users);
?>