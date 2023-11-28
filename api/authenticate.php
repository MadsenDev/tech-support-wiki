<?php
function isAuthenticated($redirectURL, $noAccessURL, $acceptedRoles = []) {
    // Fetch the JWT from cookie
    $incoming_jwt = $_COOKIE['jwt'] ?? null;

    if ($incoming_jwt) {
        // Call the verify endpoint on auth.madsens.dev to decode the JWT
        $response = file_get_contents("https://auth.madsens.dev/api/verify.php?token=$incoming_jwt");
        $decoded_response = json_decode($response, true);

        if ($decoded_response['status'] === 'success') {
            $userData = $decoded_response['data'];

            // Check if the user role is one of the accepted roles, if specified
            if (empty($acceptedRoles) || in_array($userData['role'], $acceptedRoles)) {
                return $userData;
            } else {
                header('Location: ' . $noAccessURL);
                exit();
            }

        } else {
            header('Location: ' . $redirectURL);
            exit();
        }
    } else {
        header('Location: ' . $redirectURL);
        exit();
    }
}

function checkAuthentication($acceptedRoles = []) {
    $response = [
        'isAuthenticated' => false,
        'role' => null,
        'data' => null
    ];

    // Fetch the JWT from cookie
    $incoming_jwt = $_COOKIE['jwt'] ?? null;

    if ($incoming_jwt) {
        // Call the verify endpoint on auth.madsens.dev to decode the JWT
        $api_response = file_get_contents("https://auth.madsens.dev/api/verify.php?token=$incoming_jwt");
        $decoded_response = json_decode($api_response, true);

        if ($decoded_response['status'] === 'success') {
            $userData = $decoded_response['data'];

            // Check if the user role is one of the accepted roles, if specified
            if (empty($acceptedRoles) || in_array($userData['role'], $acceptedRoles)) {
                $response['isAuthenticated'] = true;
                $response['role'] = $userData['role'];
                $response['data'] = $userData;
            }
        }
    }

    return $response;
}
?>