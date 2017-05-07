<?php

namespace Rundeck;

use Rundeck\Resources\Execution;

/**
 * Class ExecutionTest
 * @package Rundeck
 */
class ExecutionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test class exists
     */
    public function testClassExists()
    {
        $this->assertTrue(class_exists("\\Rundeck\\Resources\\Execution"));
    }

    /**
     * Test get execution info
     */
    public function testGetInfo()
    {
        $httpClient = new MockHttpClient(__DIR__."/data/execution/find.xml");

        $execution = new Execution($httpClient->getClient());

        $this->assertArrayHasKey("execution", $execution->find());
    }

    /**
     * Test get aborted executions
     */
    public function testGetAbort()
    {
        $httpClient = new MockHttpClient(__DIR__."/data/execution/abort.xml");

        $execution = new Execution($httpClient->getClient());

        $this->assertArrayHasKey("@attributes", $execution->get("abort"));
    }

    /**
     * Test get output
     */
    public function testGetOutput()
    {
        $httpClient = new MockHttpClient(__DIR__."/data/execution/output.xml");

        $execution = new Execution($httpClient->getClient());

        $this->assertArrayHasKey("entries", $execution->get("output"));
    }

    /**
     * Test get state
     */
    public function testGetState()
    {
        $httpClient = new MockHttpClient(__DIR__."/data/execution/state.xml");

        $execution = new Execution($httpClient->getClient());

        $this->assertArrayHasKey("steps", $execution->get("state"));
    }

    /**
     * Test get output state
     */
    public function testGetOutputState()
    {
        $httpClient = new MockHttpClient(__DIR__."/data/execution/output-state.xml");

        $execution = new Execution($httpClient->getClient());

        $this->assertArrayHasKey("entries", $execution->get("output/state"));
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid Action: exception
     */
    public function testExceptionAction()
    {
        $execution = new Execution(new HttpClient());

        $execution->get("exception");
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Invalid Format: wrong-format
     */
    public function testExceptionFormat()
    {
        $execution = new Execution(new HttpClient());

        $execution->get("state", "wrong-format");
    }
}
