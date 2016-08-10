<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BasicImage
 *
 * @author Lieven
 */
class BasicImagePackage {

    public function register(\Slim\App $app) {
        $app->get('/greyscale/{filename}', function ($request, $response, $args) {
            
            $file = getFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_GRAYSCALE);
        });

        $app->get('/negate/{filename}', function ($request, $response, $args) {
            $file = getFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_NEGATE);
        });

        $app->get('/edgedetect/{filename}', function ($request, $response, $args) {
            $file = getFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_EDGEDETECT);
        });

        $app->get('/brightness/{filename}/{brightness}', function ($request, $response, $args) {
            $file = getFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_BRIGHTNESS, $args['brightness']);
        });

        $app->get('/contrast/{filename}/{contrast}', function ($request, $response, $args) {
            $file = getFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_CONTRAST, $args['contrast']);
        });

        $app->get('/emboss/{filename}', function ($request, $response, $args) {
            $file = getFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_EMBOSS);
        });

        $app->get('/gaussianblur/{filename}', function ($request, $response, $args) {
            $file = getFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_GAUSSIAN_BLUR);
        });

        $app->get('/selectiveblur/{filename}', function ($request, $response, $args) {
            $file = getFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_SELECTIVE_BLUR);
        });

        $app->get('/smooth/{filename}/{smoothnumber}', function ($request, $response, $args) {
            $file = getFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_SMOOTH, $args['smoothnumber']);
        });

        $app->get('/pixelate/{filename}/{pixelsize}', function ($request, $response, $args) {
            $file = getFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_PIXELATE, $args['pixelsize']);
        });

        $app->get('/crop/{filename}/{x}/{y}/{width}/{height}', function ($request, $response, $args) {
            $file = getFile($args);
            $x = $args['x'];
            $y = $args['y'];
            $width = $args['width'];
            $height = $args['height'];
            $rect = ["x" => $x, "y" => $y, "width" => $width, "height" => $height];
            $imageResource = imagecreatefromjpeg($file);
            $imageResource = imagecrop($imageResource, $rect);
            imagejpeg($imageResource);
                
            $response = $response->withHeader('Content-Description', 'File Transfer')
                    ->withHeader('Content-Type', 'application/octet-stream')
                    ->withHeader('Content-Disposition', 'attachment;filename="' . basename($file) . '"')
                    ->withHeader('Expires', '0')
                    ->withHeader('Cache-Control', 'must-revalidate')
                    ->withHeader('Pragma', 'public')
                    ->withHeader('Content-Length', BasicImagePackage::getImageLen($imageResource));
            imagejpeg($imageResource);
            return $response;
        });

        $app->get('/rotate/{filename}/{degrees}/{color}', function ($request, $response, $args) {
            $file = getFile($args);
            $degrees = $args['degrees'];
            $rgb = $args['color'];
            $imageResource = imagecreatefromjpeg($file);
            $imageResource = imagerotate($imageResource, $degrees, 0);
            
            $response = $response->withHeader('Content-Description', 'File Transfer')
                    ->withHeader('Content-Type', 'application/octet-stream')
                    ->withHeader('Content-Disposition', 'attachment;filename="' . basename($file) . '"')
                    ->withHeader('Expires', '0')
                    ->withHeader('Cache-Control', 'must-revalidate')
                    ->withHeader('Pragma', 'public')
                    ->withHeader('Content-Length', BasicImagePackage::getImageLen($imageResource));
            
            imagejpeg($imageResource);
            return $response;
        });

//put other images behind overlayish images.

    }

    public static function doPhpFunctionOnImage($file, $response, $filter, $arg1 = null, $arg2 = null)
    {
        $imageResource = imagecreatefromjpeg($file);
        imagefilter($imageResource, $filter, $arg1);
        
        $response = $response->withHeader('Content-Description', 'File Transfer')
                ->withHeader('Content-Type', 'application/octet-stream')
                ->withHeader('Content-Disposition', 'attachment;filename="' . basename($file) . '"')
                ->withHeader('Expires', '0')
                ->withHeader('Cache-Control', 'must-revalidate')
                ->withHeader('Pragma', 'public')
                ->withHeader('Content-Length', BasicImagePackage::getImageLen($imageResource));
        imagejpeg($imageResource);
        return $response;
    }
    
    private static function getImageLen($imageResource)
    {
        $tempFile = tempnam(sys_get_temp_dir(), "img");
        imagejpeg($imageResource, $tempFile);
        return filesize($tempFile);
    }


}