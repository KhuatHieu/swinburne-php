<?php

function sanitise_input($data): ?string
{
    if (empty($data)) {
        return null;
    }

    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}

function valueFromGet($key)
{
    return sanitise_input($_GET[$key] ?? null);
}

function valueFromPost($key)
{
    return sanitise_input($_POST[$key] ?? null);
}

function existsFromPost($key): bool
{
    return isset($_POST[$key]);
}