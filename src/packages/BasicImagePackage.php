<?php

namespace packages;

use Slim\Http\UploadedFile;

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
        $app->get('/selectiveblur/demo', function ($request, $response, $args) {
            $file = getDemoFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_SELECTIVE_BLUR);
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
                
            $response = $response->withHeader('Content-Description', 'File Transfer')
                    ->withHeader('Content-Type', 'application/octet-stream')
                    ->withHeader('Content-Disposition', 'attachment;filename="' . basename($file) . '"')
                    ->withHeader('Expires', '0')
                    ->withHeader('Cache-Control', 'must-revalidate')
                    ->withHeader('Pragma', 'public');
            imagejpeg($imageResource);
            return $response;
        });
        $app->get('/gaussianblur/demo', function ($request, $response, $args) {
            $file = getDemoFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_GAUSSIAN_BLUR);
        });
        
        

        $app->post('/greyscale', function ($request, $response, $args) {
            return BasicImagePackage::doPhpFunctionOnImage(getPostFile($request), $response, IMG_FILTER_GRAYSCALE);
        });
        $app->post('/negate', function ($request, $response, $args) {
            return BasicImagePackage::doPhpFunctionOnImage(getPostFile($request), $response, IMG_FILTER_NEGATE);
        });
        $app->post('/edgedetect', function ($request, $response, $args) {
            return BasicImagePackage::doPhpFunctionOnImage(getPostFile($request), $response, IMG_FILTER_EDGEDETECT);
        });
        
        $app->post('/brightness/{brightness}', function ($request, $response, $args) {
            return BasicImagePackage::doPhpFunctionOnImage(getPostFile($request), $response, IMG_FILTER_BRIGHTNESS, $args['brightness']);
        });

        $app->post('/contrast/{contrast}', function ($request, $response, $args) {
            return BasicImagePackage::doPhpFunctionOnImage(getPostFile($request), $response, IMG_FILTER_CONTRAST, $args['contrast']);
        });

        $app->post('/emboss', function ($request, $response, $args) {
            return BasicImagePackage::doPhpFunctionOnImage(getPostFile($request), $response, IMG_FILTER_EMBOSS);
        });

        $app->post('/gaussianblur', function ($request, $response, $args) {
            return BasicImagePackage::doPhpFunctionOnImage(getPostFile($request), $response, IMG_FILTER_GAUSSIAN_BLUR);
        });
        


        $app->post('/selectiveblur', function ($request, $response, $args) {
            return BasicImagePackage::doPhpFunctionOnImage(getPostFile($request), $response, IMG_FILTER_SELECTIVE_BLUR);
        });

        
        $app->get('/smooth/demo/{smoothnumber}', function ($request, $response, $args) {
            $file = getDemoFile($args);
            return BasicImagePackage::doPhpFunctionOnImage($file, $response, IMG_FILTER_SMOOTH, $args['smoothnumber']);
        });
        
        $app->post('/smooth/{smoothnumber}', function ($request, $response, $args) {
            return BasicImagePackage::doPhpFunctionOnImage(getPostFile($request), $response, IMG_FILTER_SMOOTH, $args['smoothnumber']);
        });

        
        $app->post('/pixelate/{pixelsize}', function ($request, $response, $args) {
            return BasicImagePackage::doPhpFunctionOnImage(getPostFile($request), $response, IMG_FILTER_PIXELATE, $args['pixelsize']);
        });

        $app->post('/crop/{x}/{y}/{width}/{height}', function ($request, $response, $args) {
            $file = getPostFile($request);
            $x = $args['x'];
            $y = $args['y'];
            $width = $args['width'];
            $height = $args['height'];
            $rect = ["x" => $x, "y" => $y, "width" => $width, "height" => $height];
            $imageResource = imagecreatefromjpeg($file);
            $imageResource = imagecrop($imageResource, $rect);
                
            $response = $response->withHeader('Content-Description', 'File Transfer')
                    ->withHeader('Content-Type', 'application/octet-stream')
                    ->withHeader('Content-Disposition', 'attachment;filename="' . basename($file) . '"')
                    ->withHeader('Expires', '0')
                    ->withHeader('Cache-Control', 'must-revalidate')
                    ->withHeader('Pragma', 'public');
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

        $app->post('/rotate/{degrees}/{color}', function ($request, $response, $args) {
            $file = getPostFile($request);
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
                ->withHeader('Pragma', 'public');
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
