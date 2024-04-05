<?php

require_once 'helpers/request.php';

function validate($param, $closure, $errorMessage): void
{
    if (!$closure(valueFromPost($param))) {
        $_SESSION['errors'][$param] = $errorMessage;
    }
}

function checkValidates(): void
{
    if (!empty($_SESSION['errors'])) {
        $_SESSION["old"] = $_POST;

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}