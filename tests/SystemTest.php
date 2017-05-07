<?php

namespace Rundeck;

use Rundeck\Resources\System;

/**
 * Class SystemTest
 * @package Rundeck
 */
class SystemTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test get system info
     */
    public function testGetInfo()
    {
        $httpClient = new MockHttpClient(__DIR__."/data/system/info.xml");

        $system = new System($httpClient->getClient());

        $this->assertArrayHasKey("rundeck", $system->get("info"));
    }

    /**
     * Test get log storage
     */
    public function testGetLogstorage()
    {
        $httpClient = new MockHttpClient(__DIR__."/data/system/logstorage.xml");

        $system = new System($httpClient->getClient());

        $this->assertArrayHasKey("succeededCount", $system->get("logstorage"));
    }

    /**
     * Test get log storage incomplete
     */
    public function testGetLogstorageIncomplete()
    {
        $httpClient = new MockHttpClient(__DIR__."/data/system/logstorage-incomplete.xml");

        $system = new System($httpClient->getClient());

        $this->assertArrayHasKey("execution", $system->get("logstorage/incomplete"));
    }
}
