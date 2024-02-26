<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // User is not logged in - redirect to login page or show an error
    header("Location: login.php");
    exit;
}