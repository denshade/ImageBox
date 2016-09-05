<?php 
$I = new ApiTester($scenario);
$I->wantTo('perform actions and see result');
$I->sendGet("/qrcode/text");
$qrImage = $I->grabResponse();
file_put_contents("qrImg.png", $qrImage);

$I->sendPOST('/qrscan', [], [ 'someFile' => "qrImg.png"]);
$I->seeResponseCodeIs(200);
$I->seeResponseContains("text");