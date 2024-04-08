<?php

// Sanitise input data to prevent XSS and SQL injection attacks
function sanitise_input($data): ?string
{
    if (empty($data)) {
        return null;
    }

    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}

// Retrieve a sanitized value from the GET request parameters
function valueFromGet($key)
{
    return sanitise_input($_GET[$key] ?? null);
}

// Retrieve a sanitized value from the POST request parameters
function valueFromPost($key)
{
    return sanitise_input($_POST[$key] ?? null);
}

// Check if a POST parameter exists
function existsFromPost($key): bool
{
    return isset($_POST[$key]);
}
