<?php

namespace MirkoIO\RescueTime\Tests;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testApiRequest()
    {
        $apiKey = 'secret';

        $client = new \MirkoIO\RescueTime\Client($apiKey);
        $client->request();
    }
}
