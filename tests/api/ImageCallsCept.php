<?php 
$I = new ApiTester($scenario);
$I->wantTo('perform a ping');
$I->sendGet("ping");
$I->seeResponseContains('pong');
