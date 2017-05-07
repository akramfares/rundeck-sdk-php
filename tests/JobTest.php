<?php

namespace Rundeck;

use Rundeck\Resources\Job;

/**
 * Class JobTest
 * @package Rundeck
 */
class JobTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test class exists
     */
    public function testClassExists()
    {
        $this->assertTrue(class_exists("\\Rundeck\\Resources\\Job"));
    }
    
    /**
     * Test get job info
     */
    public function testGetInfo()
    {
        $httpClient = new MockHttpClient(__DIR__."/data/job/find.xml");

        $job = new Job($httpClient->getClient(), "c4ec2b60-ac83-4ee2-9266-67ce795c9603");

        $this->assertArrayHasKey("job", $job->find());
    }

    /**
     * Test get job executions
     */
    public function testGetHistory()
    {
        $httpClient = new MockHttpClient(__DIR__."/data/job/executions.xml");

        $job = new Job($httpClient->getClient(), "c4ec2b60-ac83-4ee2-9266-67ce795c9603");

        $this->assertArrayHasKey("execution", $job->get("executions"));
    }
}
