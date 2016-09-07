<?php 
$I = new ApiTester($scenario);
$I->wantTo('perform a ping');
$I->sendGet("ping");
$I->seeResponseContains('pong');

$I->sendPOST('/greyscale', [], [ 'someFile' => codecept_data_dir('jpeg.jpg')]);
$I->seeResponseCodeIs(200);

$I->sendPOST('/negate', [], [ 'someFile' => codecept_data_dir('jpeg.jpg')]);
$I->seeResponseCodeIs(200);

$I->sendPOST('/edgedetect', [], [ 'someFile' => codecept_data_dir('jpeg.jpg')]);
$I->seeResponseCodeIs(200);

$I->sendPOST('/brightness/12', [], [ 'someFile' => codecept_data_dir('jpeg.jpg')]);
$I->seeResponseCodeIs(200);

$I->sendPOST('/contrast/12', [], [ 'someFile' => codecept_data_dir('jpeg.jpg')]);
$I->seeResponseCodeIs(200);

$I->sendPOST('/emboss', [], [ 'someFile' => codecept_data_dir('jpeg.jpg')]);
$I->seeResponseCodeIs(200);

$I->sendPOST('/gaussianblur', [], [ 'someFile' => codecept_data_dir('jpeg.jpg')]);
$I->seeResponseCodeIs(200);

$I->sendPOST('/selectiveblur', [], [ 'someFile' => codecept_data_dir('jpeg.jpg')]);
$I->seeResponseCodeIs(200);

$I->sendPOST('/smooth/2', [], [ 'someFile' => codecept_data_dir('jpeg.jpg')]);
$I->seeResponseCodeIs(200);

$I->sendPOST('/pixelate/2', [], [ 'someFile' => codecept_data_dir('jpeg.jpg')]);
$I->seeResponseCodeIs(200);

$I->sendPOST('/crop/2/3/10/10', [], [ 'someFile' => codecept_data_dir('jpeg.jpg')]);
$I->seeResponseCodeIs(200);

$I->sendPOST('/rotate/12/0', [], [ 'someFile' => codecept_data_dir('jpeg.jpg')]);
$I->seeResponseCodeIs(200);
