<?php

// Database configuration
$db_host = 'localhost';  // or '127.0.0.1'
$db_port = '3306';       // default MySQL port
$db_user = 'root';
$db_pass = '';          // empty password without space
$db_name = 'yayasan ar-rahmah';

try {
    // Create connection with port specification
    $db = new mysqli(
        $db_host, 
        $db_user, 
        $db_pass, 
        $db_name, 
        $db_port
    );

    // Check connection
    if ($db->connect_error) {
        throw new Exception("Connection failed: " . $db->connect_error);
    }

    // Set charset - Fixed: Use object-oriented approach
    if (!$db->set_charset("utf8mb4")) {
        throw new Exception("Error setting charset: " . $db->error);
    }

    // Test the connection with a simple query
    $test = $db->query("SELECT 1");
    if (!$test) {
        throw new Exception("Database test query failed");
    }

} catch (Exception $e) {
    // Log the detailed error
    error_log("Database connection error: " . $e->getMessage());
    
    // Show user-friendly message
    $error_message = "Maaf, terjadi kesalahan pada koneksi database. " . 
                    "Silakan coba beberapa saat lagi atau hubungi administrator.";
    
    // In development environment, you might want to see the actual error
    if (defined('ENVIRONMENT') && ENVIRONMENT === 'development') {
        $error_message .= "\nDetail error: " . $e->getMessage();
    }
    
    die($error_message);
}

// Make connection available globally if needed
global $db;
?>