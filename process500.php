<?php
// Enable error reporting and logging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', '/home/LogFiles/php_errors.log');

// Log the simulated 500 error
error_log("Simulated HTTP 500 Internal Server Error triggered via process500.php");

// Set HTTP response code to 500
http_response_code(500);

// Return structured JSON error response
header('Content-Type: application/json');
echo json_encode([
    'error' => 'Internal Server Error',
    'message' => 'This is a simulated 500 error for demonstration purposes.'
]);
exit();
?>

