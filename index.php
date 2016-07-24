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
        'addContentLengthHeader' => false,
        ]];
$app = new \Slim\App($config);

// Define app routes
$app->get('/hello/{name}', function ($request, $response, $args) {
    return $response->write("Hello " . $args['name']);
});

$app->get('/greyscale', function ($request, $response, $args) {

    $file = 'jpeg example.jpg';
    return doPhpFunctionOnImage($file, $response, IMG_FILTER_GRAYSCALE);
});

$app->get('/negate', function ($request, $response, $args) {
    $file = 'jpeg example.jpg';
    return doPhpFunctionOnImage($file, $response, IMG_FILTER_NEGATE);
});

$app->get('/edgedetect', function ($request, $response, $args) {
    $file = 'jpeg example.jpg';
    return doPhpFunctionOnImage($file, $response, IMG_FILTER_EDGEDETECT);
});

$app->get('/brightness/{brightness}', function ($request, $response, $args) {
    $file = 'jpeg example.jpg';
    return doPhpFunctionOnImage($file, $response, IMG_FILTER_BRIGHTNESS, $args['brightness']);
});

$app->get('/contrast/{contrast}', function ($request, $response, $args) {
    $file = 'jpeg example.jpg';
    return doPhpFunctionOnImage($file, $response, IMG_FILTER_CONTRAST, $args['contrast']);
});

$app->get('/emboss', function ($request, $response, $args) {
    $file = 'jpeg example.jpg';
    return doPhpFunctionOnImage($file, $response, IMG_FILTER_EMBOSS);
});

$app->get('/gaussianblur', function ($request, $response, $args) {
    $file = 'jpeg example.jpg';
    return doPhpFunctionOnImage($file, $response, IMG_FILTER_GAUSSIAN_BLUR);
});

$app->get('/selectiveblur', function ($request, $response, $args) {
    $file = 'jpeg example.jpg';
    return doPhpFunctionOnImage($file, $response, IMG_FILTER_SELECTIVE_BLUR);
});

$app->get('/smooth/{smoothnumber}', function ($request, $response, $args) {
    $file = 'jpeg example.jpg';
    return doPhpFunctionOnImage($file, $response, IMG_FILTER_SMOOTH, $args['smoothnumber']);
});

$app->get('/pixelate/{pixelsize}', function ($request, $response, $args) {
    $file = 'jpeg example.jpg';
    return doPhpFunctionOnImage($file, $response, IMG_FILTER_PIXELATE, $args['pixelsize']);
});
// Run app
$app->run();
