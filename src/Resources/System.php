<?php

namespace Rundeck\Resources;

use Rundeck\HttpClient;

class System
{
    private $name;
    private $client;

    private $actions = [
        "info",
        "logstorage",
        "logstorage/incomplete"
    ];

    public function __construct(HttpClient $client, $name = null)
    {
        $this->name = $name;
        $this->client = $client;
    }

    public function get($action, $alt = "xml")
    {
        if (in_array($action, $this->actions)) {
            $response = $this->client->get('/system/'. $action, $alt);
            return $response;
        } else {
            throw new \Exception("Action invalid.");
        }
    }
}
