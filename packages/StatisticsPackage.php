<?php

/**
 * Created by PhpStorm.
 * User: Lieven
 * Date: 10-9-2016
 * Time: 13:23
 */
class StatisticsPackage
{
    public function register(\Slim\App $app) {
        //Returns t value. Take 2 vectors of numbers.
        // data={ "x" => [1,2,3], "y" => [2,3,4] }
        $app->post('/ttest/{p}', function ($request, $response, $args) {
            $p = $args['p'];
            $request->post("data");
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
}