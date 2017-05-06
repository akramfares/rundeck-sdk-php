<?php

namespace Rundeck\Resources;

use Rundeck\HttpClient;

class Project
{

    private $name;
    private $client;

    private $actions = [
        "jobs" => ["xml"],
        "jobs/export" => ["xml"],
        "resources" => ["xml"],
        "executions" => ["xml"],
        "executions/running" => ["xml"],
        "export" => ["xml"],
        "history" => ["xml"],
    ];

    public function __construct(HttpClient $client, $name = null)
    {
        $this->name = $name;
        $this->client = $client;
    }

    public function find($alt = "xml")
    {
        $response = $this->client->get('/project/'.$this->name, $alt);
        return $response;
    }

    public function findAll($alt = "xml")
    {
        $response = $this->client->get('/projects', $alt);
        return $response;
    }

    public function get($action, $alt = "xml")
    {
        if (array_key_exists($action, $this->actions)) {
            if (!in_array($alt, $this->actions[$action])) {
                throw new \Exception("Invalid Format: ". $alt);
            }
            $response = $this->client->get('/project/'.$this->name. '/' .$action, $alt);
            return $response;
        } else {
            throw new \Exception("Action invalid.");
        }
    }

    public function resource($name, $alt = "xml")
    {
        $response = $this->client->get('/project/'.$this->name. '/resource/' .$name, $alt);
        return $response;
    }
}
