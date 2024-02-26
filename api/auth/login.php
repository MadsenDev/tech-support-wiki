<?php
session_start();
require '../db.php'; // Adjust the path as necessary to where your db.php is located

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        // Handle error - both fields are required
        exit('Both username and password are required');
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Login successful - set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['rank_id'] = $user['rank_id'];
        // Redirect to a protected page or dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        // Handle error - invalid credentials
        exit('Login failed: Invalid username or password.');
    }
}
?>