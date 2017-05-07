<?php

namespace Rundeck;

use Rundeck\Resources\Project;

/**
 * Class ProjectTest
 * @package Rundeck
 */
class ProjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test class exists
     */
    public function testClassExists()
    {
        $this->assertTrue(class_exists("\\Rundeck\\Resources\\Project"));
    }

    /**
     * Test get project history
     */
    public function testGetHistory()
    {
        $httpClient = new MockHttpClient(__DIR__."/data/project/history.xml");

        $project = new Project($httpClient->getClient(), "MyProject");

        $this->assertArrayHasKey("event", $project->get("history"));
    }


    /**
     * Test get project info
     */
    public function testGetInfo()
    {
        $httpClient = new MockHttpClient(__DIR__."/data/project/find.xml");

        $project = new Project($httpClient->getClient(), "MyProject");

        $this->assertArrayHasKey("name", $project->find());
    }

    /**
     * Test get all projects
     */
    public function testGetAll()
    {
        $httpClient = new MockHttpClient(__DIR__."/data/project/findall.xml");

        $project = new Project($httpClient->getClient());

        $this->assertArrayHasKey("project", $project->findAll());
    }


    /**
     * Test get project resource
     */
    public function testGetResource()
    {
        $httpClient = new MockHttpClient(__DIR__."/data/project/resource.xml");

        $project = new Project($httpClient->getClient(), "MyProject");

        $this->assertArrayHasKey("node", $project->resource("localhost"));
    }
}
