<?php

namespace Rundeck\Resources;

use Rundeck\HttpClient;

class Job
{

    private $name;
    private $client;

    private $actions = [
        "executions" => ["xml"],
        "input/files" => ["xml"],
        "info" => ["xml"],
    ];

    public function __construct(HttpClient $client, $name = null)
    {
        $this->name = $name;
        $this->client = $client;
    }

    public function find($alt = "xml")
    {
        $response = $this->client->get('/job/'.$this->name, $alt);
        return $response;
    }

    public function get($action, $alt = "xml")
    {
        if (array_key_exists($action, $this->actions)) {
            if (!in_array($alt, $this->actions[$action])) {
                throw new \Exception("Invalid Format: ". $alt);
            }
            $response = $this->client->get('/job/'.$this->name. '/' .$action, $alt);
            return $response;
        } else {
            throw new \Exception("Action invalid.");
        }
    }
}
