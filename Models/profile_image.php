<?php
header("Content-Type: image/png");

// Get the first letter of the email
$email = $_GET['email'] ?? 'guest@example.com'; // Fallback if no email is passed
$firstLetter = strtoupper($email[0]);

// Create a square image
$imageSize = 200; // Size of the image
$image = imagecreatetruecolor($imageSize, $imageSize);

// Colors
$greenBackground = imagecolorallocate($image, 126, 217, 87); // Green background
$blueText = imagecolorallocate($image, 56, 182, 255);         // Blue text

// Fill the background
imagefill($image, 0, 0, $greenBackground);

// Path to Orkney font (OTF format)
$fontPath = __DIR__ . '/../assets/fonts/orkney/Orkney-Bold.otf';

// Add the letter using the Orkney font
$fontSize = 80; // Font size in points
$textBox = imagettfbbox($fontSize, 0, $fontPath, $firstLetter);

// Calculate position to center the text
$textWidth = $textBox[2] - $textBox[0];
$textHeight = $textBox[1] - $textBox[7];
$textX = ($imageSize - $textWidth) / 2;
$textY = ($imageSize + $textHeight) / 2;

// Add the text
imagettftext($image, $fontSize, 0, $textX, $textY, $blueText, $fontPath, $firstLetter);

// Output the image
imagepng($image);
imagedestroy($image);

?>
