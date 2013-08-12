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

    public function testGetByRank()
    {
        $data = file_get_contents(FAKES_PATH . '/rank.json');

        $requestParams = array('perspective' => 'rank');

        $httpClient = $this->getMockBuilder('\MirkoIO\RescueTime\HttpClient')
            ->setConstructorArgs(array($requestParams))
            ->setMethods(array('request'))
            ->getMock();
        $httpClient->expects($this->once())
            ->method('request')
            ->will($this->returnValue(json_decode($data, true)));

        $this->Client->setClient($httpClient);

        $activities = $this->Client->getActivities("rank");

        $this->assertTrue(is_array($activities), "Expected activities to be an array");
        $this->assertEquals(15, count($activities), "Expected to return 15 activities");
    }

    public function testGetByInterval()
    {
        $data = file_get_contents(FAKES_PATH . '/interval.json');

        $requestParams = array('perspective' => 'interval');

        $httpClient = $this->getMockBuilder('\MirkoIO\RescueTime\HttpClient')
            ->setConstructorArgs(array($requestParams))
            ->setMethods(array('request'))
            ->getMock();
        $httpClient->expects($this->once())
            ->method('request')
            ->will($this->returnValue(json_decode($data, true)));

        $this->Client->setClient($httpClient);

        $activities = $this->Client->getActivities("interval");

        $this->assertTrue(is_array($activities), "Expected activities to be an array");
        $this->assertEquals(14, count($activities), "Expected to return 14 activities");
    }

    public function testGetByMember()
    {
        $data = file_get_contents(FAKES_PATH . '/member.json');

        $requestParams = array('perspective' => 'member');

        $httpClient = $this->getMockBuilder('\MirkoIO\RescueTime\HttpClient')
            ->setConstructorArgs(array($requestParams))
            ->setMethods(array('request'))
            ->getMock();
        $httpClient->expects($this->once())
            ->method('request')
            ->will($this->returnValue(json_decode($data, true)));

        $this->Client->setClient($httpClient);

        $activities = $this->Client->getActivities("member");

        $this->assertTrue(is_array($activities), "Expected activities to be an array");
        $this->assertEquals(17, count($activities), "Expected to return 17 activities");
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
