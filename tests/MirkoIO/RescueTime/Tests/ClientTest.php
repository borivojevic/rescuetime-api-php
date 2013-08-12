<?php

namespace MirkoIO\RescueTime\Tests;

class ClientTest extends \PHPUnit_Framework_TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $apiKey = 'secret';
        $this->Client = new \MirkoIO\RescueTime\Client($apiKey);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->Client);
    }

    public function testApiRequest()
    {
        $result = $this->Client->getActivities("rank");
        $result = $this->Client->getActivities("interval");
        $result = $this->Client->getActivities("member");
    }

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage Perspective must be one of rank, interval or member
     */
    public function testInvalidPerspective()
    {
        $this->Client->getActivities('invalid_perspective_name');
    }

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage Resolution time must be one of month, week, day or hour
     */
    public function testInvalidResolutionTime()
    {
        $this->Client->getActivities(null, 'invalid_resolution_time');
    }

    /**
     * @expectedException        Exception
     * @expectedExceptionMessage Restrict kind must be one of category, activity, productivity
     */
    public function testInvalidRestrictKind()
    {
        $this->Client->getActivities(null, null, null, null, null, null, 'invalid_restrict_kind');
    }
}
