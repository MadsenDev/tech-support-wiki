<?php
function validateApiKey($key, $db) {
    $stmt = $db->prepare("SELECT * FROM api_keys WHERE api_key = ?");
    $stmt->execute([$key]);
    return $stmt->fetch();
}

function rateLimit($apiKeyId, $db) {
    $stmt = $db->prepare("SELECT * FROM rate_limiting WHERE api_key_id = ?");
    $stmt->execute([$apiKeyId]);
    $data = $stmt->fetch();

    $current_time = new DateTime();
    if ($data) {
        $reset_time = new DateTime($data['reset_time']);
        $time_diff = $current_time->getTimestamp() - $reset_time->getTimestamp();
        
        if ($time_diff > 60) {
            $stmt = $db->prepare("UPDATE rate_limiting SET request_count = 1, reset_time = NOW() WHERE api_key_id = ?");
            $stmt->execute([$apiKeyId]);
        } elseif ($data['request_count'] >= 60) {
            return false;
        } else {
            $stmt = $db->prepare("UPDATE rate_limiting SET request_count = request_count + 1 WHERE api_key_id = ?");
            $stmt->execute([$apiKeyId]);
        }
    } else {
        $stmt = $db->prepare("INSERT INTO rate_limiting (api_key_id, request_count, reset_time) VALUES (?, 1, NOW())");
        $stmt->execute([$apiKeyId]);
    }
    return true;
}

function validateInternalApiKey($db) {
    // Load the .env file
    $env_path = '/.env';
    $internal_api_key = "fallback_api_key_here"; // default value

    if (file_exists($env_path)) {
        $env = parse_ini_file($env_path);
        if (array_key_exists('API_KEY', $env)) {
            $internal_api_key = $env['API_KEY'];
        }
    }

    // Validate the internal API key against the database
    $stmt = $db->prepare("SELECT * FROM api_keys WHERE api_key = ?");
    $stmt->execute([$internal_api_key]);
    return $stmt->fetch();
}
?>