<?php 
$I = new ApiTester($scenario);
$I->wantTo('perform actions and see result');
$I->sendGet("/qrcode/text");
$qrImage = $I->grabResponse();
file_put_contents("qrImg.png", $qrImage);

$I->sendPOST('/qrscan', [], [ 'someFile' => "qrImg.png"]);
$I->seeResponseCodeIs(200);
$I->seeResponseContains("text");

unlink("qrImg.png");


$I->wantTo('perform actions and see result');
$I->sendGet("/qrcode/0/3/4/text");
$qrImage = $I->grabResponse();
file_put_contents("qrImg.png", $qrImage);

$I->sendPOST('/qrscan', [], [ 'someFile' => "qrImg.png"]);
$I->seeResponseCodeIs(200);
$I->seeResponseContains("text");

unlink("qrImg.png");

$I->wantTo('perform actions and see result');
$I->sendGet("/qrcode/3/15/40/text");
$qrImage = $I->grabResponse();
file_put_contents("qrImg.png", $qrImage);

$I->sendPOST('/qrscan', [], [ 'someFile' => "qrImg.png"]);
$I->seeResponseCodeIs(200);
$I->seeResponseContains("text");

unlink("qrImg.png");


$I->wantTo('perform actions and see result');
$I->sendGet("/qrcode/4/15/40/text");
$I->seeResponseCodeIs(400);

//$I->sendPOST('/qrscan', [], [ 'someFile' => "qrImg.png"]);
//$I->seeResponseCodeIs(400);

//unlink("qrImg.png");