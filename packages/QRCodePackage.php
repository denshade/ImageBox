<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QRCodePackage
 *
 * @author lveeckha
 */
class QRCodePackage {
    public function register(\Slim\App $app) {
        $app->get('/qrcode/{text}', function ($request, $response, $args) {
            $text = $args['text'];
            $response = $response->withHeader('Content-Description', 'File Transfer')
                ->withHeader('Content-Type', 'application/octet-stream')
                ->withHeader('Content-Disposition', 'attachment;filename="qrcode.png"')
                ->withHeader('Expires', '0')
                ->withHeader('Cache-Control', 'must-revalidate')
                ->withHeader('Pragma', 'public');
                //->withHeader('Content-Length', 365 );
            QRcode::png($text);
            return $response;
        });
        //ec level: 0->3, size : 1 -> 3/margin 4 
        $app->get('/qrcode/{eclevel}/{size}/{margin}/{text}', function ($request, $response, $args) {
            $text = $args['text'];
            $eclevel = $args['eclevel'];
            $size = $args['size'];
            $margin = $args['margin'];
            if (!is_numeric($eclevel) || $eclevel < 0 || $eclevel > 3) badFormat ("EC level must be between 0-3"); 
            if (!is_numeric($size) || $size < 1 || $size > 100) badFormat ("Size must be between 1-100"); 
            if (!is_numeric($margin) || $margin < 1 || $margin > 100) badFormat ("Margin must be between 1-100"); 
            
            $response = $response->withHeader('Content-Description', 'File Transfer')
                ->withHeader('Content-Type', 'application/octet-stream')
                ->withHeader('Content-Disposition', 'attachment;filename="qrcode.png"')
                ->withHeader('Expires', '0')
                ->withHeader('Cache-Control', 'must-revalidate')
                ->withHeader('Pragma', 'public');
                
            QRcode::png($text, false, $eclevel, $size, $margin);
            return $response;
        });
        
        // $level = QR_ECLEVEL_L, $size = 3, $margin = 4, $saveandprint=false, $back_color = 0xFFFFFF, $fore_color = 0x000000
        
        $app->get('/qrscan/{file}', function ($request, $response, $args) {
            $file = "qrcode.png";
            $QRCodeReader = new Libern\QRCodeReader\QRCodeReader();
            $qrcode_text = $QRCodeReader->decode($file);
            echo $qrcode_text;
        });
        
        $app->post('/qrscan', function ($request, $response, $args) {
            //$file = getPostFile($request);
            //if (mime_content_type($file) != "image/png") badFormat ("Incoming image isn't a png image.");
            //error_log (mime_content_type($file));
            $QRCodeReader = new Libern\QRCodeReader\QRCodeReader();
            $qrcode_text = $QRCodeReader->decode(getPostFile($request));
            echo $qrcode_text;
        });

    }
}