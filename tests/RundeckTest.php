<?php

namespace Rundeck;

/**
 * Class RundeckTest
 * @package Rundeck
 */
class RundeckTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test class exists
     */
    public function testClassExists()
    {
        $this->assertTrue(class_exists("\\Rundeck\\Rundeck"));
    }

    /**
     * Test get project info
     */
    public function testGetInfo()
    {
        $httpClient = new MockHttpClient(__DIR__."/data/project/find.xml");

        $client = new Rundeck("http://localhost/", "my-client-secret", 18);
        $client->setClient($httpClient->getClient());

        $this->assertArrayHasKey("name", $client->project("MyProject")->find());
    }
}
