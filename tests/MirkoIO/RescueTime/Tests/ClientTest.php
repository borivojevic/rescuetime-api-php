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
        $result = $this->Client->request("rank");
        $result = $this->Client->request("interval");
        $result = $this->Client->request("member");
    }

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage Perspective must be one of rank, interval or member
     */
    public function testInvalidPerspectiveParameter()
    {
        $this->Client->request('invalid_perspective_name');
    }

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage Resolution time must be one of month, week, day or hour
     */
    public function testInvalidResolutionTimeParameter()
    {
        $this->Client->request(null, 'invalid_resolution_time');
    }

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage Restrict kind must be one of category, activity, productivity
     */
    public function testInvalidRestrictKindParameter()
    {
        $this->Client->request(null, null, null, null, null, null, 'invalid_restrict_kind');
    }
}
