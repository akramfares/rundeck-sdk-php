<?php
namespace Rundeck;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

/**
 * Class MockHttpClient
 * @package Rundeck
 */
class MockHttpClient
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @param $file
     */
    public function __construct($file)
    {
        // Create a mock handler with body from file
        $mock = new MockHandler([
            new Response(200, [], file_get_contents($file)),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $this->httpClient = new HttpClient();
        $this->httpClient->setClient($client);
    }

    /**
     * @return HttpClient
     */
    public function getClient()
    {
        return $this->httpClient;
    }
}
