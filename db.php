<?php

function getMysqli(): mysqli|bool
{
    $settings = include 'settings.php';

    try {
        return mysqli_connect(
            $settings['DB_SERVER'],
            $settings['DB_USER'],
            $settings['DB_PASSWORD'],
            $settings['DB_NAME']
        );
    } catch (mysqli_sql_exception) {
        die("Exception occurred");
    }
}

if (getMysqli()->ping()) {
    echo 'Connected';
} else {
    echo "Not connected";
}