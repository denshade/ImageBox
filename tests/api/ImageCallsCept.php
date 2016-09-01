<?php 
$I = new ApiTester($scenario);
$I->wantTo('perform a ping');
$I->sendGet("ping");
$I->seeResponseContains('pong');

$I->sendPOST('/greyscale', [], [ 'someFile' => codecept_data_dir('jpeg.jpg')]);
$I->seeResponseCodeIs(200);
