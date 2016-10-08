<?php

use packages\BasicImagePackage;
use packages\QRCodePackage;

require 'vendor/autoload.php';

// Create and configure Slim app
$config = ['settings' => [
            'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        ]];
$app = new \Slim\App($config);

require_once("basicFunctions.php");

require_once("vendor/autoload.php");
//loadPackages.

$imagePackage = new BasicImagePackage();
$imagePackage->register($app);

$qrPackage = new QRCodePackage();
$qrPackage->register($app);

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
// Nearest-neighbor interpolation
// face blur
// face detection
// QR code reader.
// Conversie van images => vector.
// OCR tracing
//
// Run app
$app->run();
