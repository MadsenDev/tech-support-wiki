<?php
include 'db.php';

$apiKey = '';

// Check if POST request is made to generate API key
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Generate API key (sanitized by bin2hex and PDO prepared statements)
    $apiKey = bin2hex(random_bytes(16));

    // Insert API key into the database
    $stmt = $db->prepare("INSERT INTO api_keys (api_key) VALUES (?)");
    $stmt->execute([$apiKey]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate API Key</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 100px;
        }
        #result {
            margin-top: 20px;
            font-weight: bold;
        }
        button {
            padding: 10px 20px;
            font-size: 18px;
        }
    </style>
</head>
<body>

    <h1>Generate Your API Key</h1>
    <form method="POST">
        <button type="submit">Create API Key</button>
    </form>
    
    <?php if ($apiKey): ?>
        <div id="result">Your API Key: <?= htmlspecialchars($apiKey); ?></div>
    <?php endif; ?>

</body>
</html>