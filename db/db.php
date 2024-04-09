<?php

// Establish a MySQLi connection or return false on failure
function getMysqli()
{
    // Load database settings from configuration file
    $settings = require __DIR__ . '/../settings.php';

    try {
        // Connect to the database server
        $mysqli = mysqli_connect(
            $settings['DB_SERVER'],
            $settings['DB_USER'],
            $settings['DB_PASSWORD']
        );

        // Create the database if it doesn't exist and select it
        $mysqli->query("CREATE DATABASE IF NOT EXISTS " . $settings['DB_NAME']);
        $mysqli->select_db($settings['DB_NAME']);

        // Create the 'eoi' table if it doesn't exist
        $result = $mysqli->query("SHOW TABLES LIKE 'eoi'");
        if ($result->num_rows === 0) {
            $mysqli->query(require_once __DIR__ . '/create_table.php');
        }

        // Return MySQLi connection
        return $mysqli;
    } catch (mysqli_sql_exception $exception) {
        // Handle any exceptions and display error messages
        echo 'Exception occurred: ' . $exception->getMessage() . '<br>';
        echo 'Stack trace: <pre>' . $exception->getTraceAsString() . '</pre>';
        die(); // Terminate script execution
    }
}
?>
