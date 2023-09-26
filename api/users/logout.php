<?php
// api/users/logout.php

session_start();

// Destroy all session variables
session_destroy();

echo json_encode(["message" => "Logged out successfully"]);
?>