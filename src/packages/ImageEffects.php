<?php

namespace packages;

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
class ImageEffectsPackage {

    public function register(\Slim\App $app) {
        
    }
    function doPhpFunctionOnImageRetro($file, $response)
    {
        $imageResource = imagecreatefromjpeg($file);

        $response = $response->withHeader('Content-Description', 'File Transfer')
                ->withHeader('Content-Type', 'application/octet-stream')
                ->withHeader('Content-Disposition', 'attachment;filename="' . basename($file) . '"')
                ->withHeader('Expires', '0')
                ->withHeader('Cache-Control', 'must-revalidate')
                ->withHeader('Pragma', 'public')
                ->withHeader('Content-Length', filesize($file));
        imagefilter($imageResource, IMG_FILTER_GRAYSCALE);
        imagefilter($imageResource, IMG_FILTER_CONTRAST, 255);
        imagefilter($imageResource, IMG_FILTER_NEGATE);
        imagefilter($imageResource, IMG_FILTER_COLORIZE, 2, 118, 219);
        imagefilter($imageResource, IMG_FILTER_NEGATE); 
        imagejpeg($imageResource);
        return $response;
    }

}
