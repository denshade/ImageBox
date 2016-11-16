<?php
/**
 * Created by PhpStorm.
 * User: Lieven
 * Date: 16-11-2016
 * Time: 13:29
 */

namespace AccessManagement;


use packages\AccessManagement\BCryptAccessManager;

class BCryptAccessManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @Test
     */
    public function testCheckAuth()
    {
        $mgr = new BCryptAccessManager();
        $hash = $mgr->getPasswordHash('password');
        $this->assertTrue($mgr->isAuthenticated("password", $hash));
    }
}
