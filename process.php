<?php

// increase execution time
set_time_limit(0);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', '/home/LogFiles/php_errors.log');

//Retrieve query parameters
$maxImages = $_GET['images'];
$imgNames  = explode(",",$_GET['imgNames']);

//Load JPEGs into an array (in memory)
for ($x=0; $x<$maxImages; $x++){
    if ($x >=3) {
                    // Simulate HTTP 500 Internal Server Error
                    http_response_code(500);

	    	    // Write a log entry
		    error_log("Simulated HTTP 500 Internal Server Error triggered intentionally.");

		    // Exit with message (simulate app error response)
		    exit("An internal server error occurred.");

    }
    $imgArray[$x] = imagecreatefromjpeg("./images/" . $imgNames[$x]);
    
}

//Loop through array and convert each JPEG to PNG
if ($imgArray) {
  for ($x=0; $x<$maxImages; $x++){
    $filename = './images/converted_' . substr($imgNames[$x],0,-4) . '.png';
    imagepng($imgArray[$x], $filename);
  }
}
