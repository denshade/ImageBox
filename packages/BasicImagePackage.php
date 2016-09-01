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
        $app->get('/greyscale/demo', function ($request, $response, $args) {
            
            $file = getDemoFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_GRAYSCALE);
        });
        $app->post('/greyscale', function ($request, $response, $args) {
            
            $file = getDemoFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_GRAYSCALE);
        });
        $app->get('/negate/demo', function ($request, $response, $args) {
            $file = getDemoFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_NEGATE);
        });

        $app->get('/edgedetect/demo', function ($request, $response, $args) {
            $file = getDemoFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_EDGEDETECT);
        });

        $app->get('/brightness/demo/{brightness}', function ($request, $response, $args) {
            $file = getDemoFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_BRIGHTNESS, $args['brightness']);
        });

        $app->get('/contrast/demo/{contrast}', function ($request, $response, $args) {
            $file = getDemoFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_CONTRAST, $args['contrast']);
        });

        $app->get('/emboss/demo', function ($request, $response, $args) {
            $file = getDemoFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_EMBOSS);
        });

        $app->get('/gaussianblur/demo', function ($request, $response, $args) {
            $file = getDemoFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_GAUSSIAN_BLUR);
        });

        $app->get('/selectiveblur/demo', function ($request, $response, $args) {
            $file = getDemoFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_SELECTIVE_BLUR);
        });

        $app->get('/smooth/demo/{smoothnumber}', function ($request, $response, $args) {
            $file = getDemoFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_SMOOTH, $args['smoothnumber']);
        });

        $app->get('/pixelate/demo/{pixelsize}', function ($request, $response, $args) {
            $file = getDemoFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_PIXELATE, $args['pixelsize']);
        });

        $app->get('/crop/demo/{x}/{y}/{width}/{height}', function ($request, $response, $args) {
            $file = getDemoFile($args);
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

        $app->get('/rotate/demo/{degrees}/{color}', function ($request, $response, $args) {
            $file = getDemoFile($args);
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
