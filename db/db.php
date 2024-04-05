<?php

function getMysqli(): mysqli|bool
{
    $settings = require_once 'settings.php';

    try {
        $mysqli = mysqli_connect(
            $settings['DB_SERVER'],
            $settings['DB_USER'],
            $settings['DB_PASSWORD']
        );

        $mysqli->query("CREATE DATABASE IF NOT EXISTS " . $settings['DB_NAME']);
        $mysqli->select_db($settings['DB_NAME']);

        $result = $mysqli->query("SHOW TABLES LIKE 'eoi'");
        if ($result->num_rows === 0) {
            $mysqli->query(require_once 'create_table.php');
        }

        return $mysqli;
    } catch (mysqli_sql_exception $exception) {
        echo 'Exception occurred: ' . $exception->getMessage() . '<br>';
        echo 'Stack trace: <pre>' . $exception->getTraceAsString() . '</pre>';
        die();
    }

}
