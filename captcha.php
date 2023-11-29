<?php
// Start the session to store the CAPTCHA code
session_start();

// Generate a random CAPTCHA code
$code = substr(md5(mt_rand()), 0, 6);

// Store the code in the session variable
$_SESSION['captcha_code'] = $code;

// Create a blank image for the CAPTCHA
$image = imagecreatetruecolor(120, 40);

// Choose a random background color
$bg_color = imagecolorallocate($image, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));

// Fill the image with the background color
imagefill($image, 0, 0, $bg_color);

// Draw random lines on the image
for ($i = 0; $i < 10; $i++) {
  $line_color = imagecolorallocate($image, mt_rand(0, 200), mt_rand(0, 200), mt_rand(0, 200));
  imageline($image, mt_rand(0, 120), mt_rand(0, 40), mt_rand(0, 120), mt_rand(0, 40), $line_color);
}

// Draw random dots on the image
for ($i = 0; $i < 100; $i++) {
  $dot_color = imagecolorallocate($image, mt_rand(0, 200), mt_rand(0, 200), mt_rand(0, 200));
  imagesetpixel($image, mt_rand(0, 120), mt_rand(0, 40), $dot_color);
}

// Draw the CAPTCHA code on the image
$text_color = imagecolorallocate($image, 0, 0, 0);
imagettftext($image, 20, 0, 20, 30, $text_color, 'arial.ttf', $code);

// Set the content type header to display the image
header('Content-Type: image/png');

// Output the image to the browser
imagepng($image);

// Clean up
imagedestroy($image);
?>