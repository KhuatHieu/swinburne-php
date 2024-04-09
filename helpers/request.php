<?php

// Sanitise input data to prevent XSS and SQL injection attacks
function sanitise_input($data)
{
    if (empty($data)) {
        return null;
    }

    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// Retrieve a sanitized value from the GET request parameters
function valueFromGet($key)
{
    return isset($_GET[$key]) ? sanitise_input($_GET[$key]) : null;
}

// Retrieve a sanitized value from the POST request parameters
function valueFromPost($key)
{
    return isset($_POST[$key]) ? sanitise_input($_POST[$key]) : null;
}

// Check if a POST parameter exists
function existsFromPost($key)
{
    return isset($_POST[$key]);
}
?>
