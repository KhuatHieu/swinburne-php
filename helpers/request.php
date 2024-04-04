<?php

function fromGet($key)
{
    return $_GET[$key] ?? '';
}

function fromPost($key)
{
    return $_POST[$key] ?? '';
}
