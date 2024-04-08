<?php

require_once __DIR__ . '/request.php';

/*
 * Validate a form parameter using a closure
 * and store error messages in session if validation fails
 */
function validate($param, $closure, $errorMessage): void
{
    if (!$closure(valueFromPost($param))) {
        $_SESSION['errors'][$param] = $errorMessage;
    }
}

// Begin validation process and redirect back if errors exist
function beginValidates(): void
{
    if (!empty($_SESSION['errors'])) {
        // Store the old form data in session
        $_SESSION["old"] = $_POST;

        // Redirect back to the previous page
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
