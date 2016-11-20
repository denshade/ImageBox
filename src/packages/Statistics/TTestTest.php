<?php
/**
 * Created by PhpStorm.
 * User: Lieven
 * Date: 5-10-2016
 * Time: 19:29
 */

namespace packages\Statistics;



class TTestTest extends \PHPUnit_Framework_TestCase
{
    public function testNull()
    {
        $t = new TTest();
        $this->assertEquals(0, $t->getWelchTValue([1,2,3],[1,2,3]));
    }

    public function getWelchTValue()
    {
        $t = new TTest();
        $this->assertEquals(1.2247448713916, $t->getWelchTValue([1,2,3],[2,3,4]));
    }

    public function testStandardDeviation()
    {
        $t = new TTest();
        $this->assertEquals(1, $t->standard_deviation([1,2,3], true));
    }

}
