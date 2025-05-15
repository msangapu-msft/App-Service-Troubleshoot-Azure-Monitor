<?php

// increase execution time
set_time_limit(0);

ini_set('memory_limit', '32M');
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', '/home/LogFiles/php_errors.log');

// Retrieve query parameters safely
$maxImages = isset($_GET['images']) ? (int)$_GET['images'] : 0;
$imgNamesParam = isset($_GET['imgNames']) ? $_GET['imgNames'] : '';
$imgNames = explode(",", $imgNamesParam);

// Initialize image array to avoid undefined variable warning
$imgArray = [];

// Load JPEGs into an array (in memory)
for ($x = 0; $x < $maxImages; $x++) {
    if ($maxImages >= 3) {
	http_response_code(500);
	header('Content-Type: application/json');
	echo json_encode([
	    'error' => 'Internal Server Error',
	    'message' => 'Image conversion failed. Please try again later.'
	]);
	exit();

    }

    // Defensive check in case $imgNames[$x] is not set
    if (isset($imgNames[$x]) && !empty($imgNames[$x])) {
        $imgPath = "./images/" . $imgNames[$x];
        if (file_exists($imgPath)) {
            $imgArray[$x] = imagecreatefromjpeg($imgPath);
        } else {
            error_log("Image file not found: $imgPath");
        }
    } else {
        error_log("Image name missing for index $x");
    }
}

// Loop through array and convert each JPEG to PNG
if (!empty($imgArray)) {
    for ($x = 0; $x < $maxImages; $x++) {
        if (isset($imgArray[$x], $imgNames[$x])) {
            $filename = './images/converted_' . substr($imgNames[$x], 0, -4) . '.png';
            imagepng($imgArray[$x], $filename);
        }
    }
}
?>
