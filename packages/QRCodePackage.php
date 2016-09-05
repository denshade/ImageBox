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
        
        $app->get('/qrscan/{file}', function ($request, $response, $args) {
            $file = "qrcode.png";
            $QRCodeReader = new Libern\QRCodeReader\QRCodeReader();
            $qrcode_text = $QRCodeReader->decode($file);
            echo $qrcode_text;
        });
        
        $app->post('/qrscan', function ($request, $response, $args) {
            $file = "qrcode.png";
            $QRCodeReader = new Libern\QRCodeReader\QRCodeReader();
            $qrcode_text = $QRCodeReader->decode($file);
            echo $qrcode_text;
        });

    }
}