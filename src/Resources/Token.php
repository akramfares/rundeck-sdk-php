<?php

namespace Rundeck\Resources;

use Rundeck\HttpClient;

class Token extends Resource
{

    public function __construct(HttpClient $client, $name = null)
    {
        $this->name = $name;
        $this->client = $client;
    }

    public function findAll($alt = "xml")
    {
        $response = $this->client->get('/tokens', $alt);
        return $response;
    }
}
