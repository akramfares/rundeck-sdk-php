<?php
namespace Rundeck;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class MockHttpClient
{

    private $httpClient;

    public function __construct($file)
    {
        $mock = new MockHandler([
            new Response(200, [], file_get_contents($file)),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $this->httpClient = new HttpClient();
        $this->httpClient->setClient($client);
    }

    public function getClient()
    {
        return $this->httpClient;
    }
}
