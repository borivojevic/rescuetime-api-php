<?php

namespace MirkoIO\RescueTime\Tests;

class ClientTest extends \PHPUnit_Framework_TestCase
{

/**
 * setUp method
 *
 * @return void
 */
    public function setUp() {
        parent::setUp();
        $apiKey = 'secret';
        $this->Client = new \MirkoIO\RescueTime\Client($apiKey);
    }

/**
 * tearDown method
 *
 * @return void
 */
    public function tearDown() {
        parent::tearDown();
        unset($this->Client);
    }

    public function testApiRequest()
    {
        $result = $this->Client->request();
        var_dump($result);
    }
}
