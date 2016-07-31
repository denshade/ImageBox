<?php

require 'vendor/autoload.php';

function doPhpFunctionOnImage($file, $response, $filter, $arg1 = null, $arg2 = null)
{
    $imageResource = imagecreatefromjpeg($file);

    $response = $response->withHeader('Content-Description', 'File Transfer')
            ->withHeader('Content-Type', 'application/octet-stream')
            ->withHeader('Content-Disposition', 'attachment;filename="' . basename($file) . '"')
            ->withHeader('Expires', '0')
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($file));
    imagefilter($imageResource, $filter, $arg1);
    imagejpeg($imageResource);
    return $response;
}
// Create and configure Slim app
$config = ['settings' => [
            'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        ]];
$app = new \Slim\App($config);

require_once("basicFunctions.php");

//loadPackages.
require_once("packages\BasicImagePackage.php");

$imagePackage = new BasicImagePackage();
$imagePackage->register($app);

// Define app routes
$app->get('/ping', function ($request, $response, $args) {
    return $response->write("pong");
});





/**
 * 
 * imagefilter($im, IMG_FILTER_GRAYSCALE);
imagefilter($im, IMG_FILTER_CONTRAST, 255);
imagefilter($im, IMG_FILTER_NEGATE);
imagefilter($im, IMG_FILTER_COLORIZE, 2, 118, 219);
imagefilter($im, IMG_FILTER_NEGATE);
 */
// face blur
// face detection
// QR code reader.
// Conversie van images => vector.
// OCR tracing
//
// Run app
$app->run();
