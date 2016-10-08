<?php
/**
 * Created by PhpStorm.
 * User: Lieven
 * Date: 5-10-2016
 * Time: 19:29
 */

namespace packages\statistics;


use packages\Statistics\TTest;

class TTestTest extends \PHPUnit_Framework_TestCase
{
    public function testPushAndPop()
    {
        $t = new TTest();
        assertEquals(0, $t->getTValue([1,2,3],[1,2,3]));

    }
}
