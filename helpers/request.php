<?php

function valueFromGet($key)
{
    return $_GET[$key] ?? null;
}

function valueFromPost($key)
{
    return $_POST[$key] ?? null;
}

function existsFromPost($key): bool
{
    return isset($_POST[$key]);
}