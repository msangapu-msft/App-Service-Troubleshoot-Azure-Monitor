<?php

// increase execution time
set_time_limit(0);

//Retrieve query parameters
$maxImages = $_GET['images'];
$imgNames  = explode(",",$_GET['imgNames']);

//Load JPEGs into an array (in memory)
for ($x=0; $x<$maxImages; $x++){
    $imgArray[$x] = imagecreatefromjpeg("./images/" . $imgNames[$x]);
    
}

//Loop through array and convert each JPEG to PNG
if ($imgArray) {
  for ($x=0; $x<$maxImages; $x++){
    $filename = './images/converted_' . substr($imgNames[$x],0,-4) . '.png';
    imagepng($imgArray[$x], $filename);
  }
}
