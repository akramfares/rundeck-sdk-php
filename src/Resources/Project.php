<?php

namespace Rundeck\Resources;

use Rundeck\HttpClient;

class Project {

    private $name;

    private $actions = [
        "jobs" => ["xml", "json"],
        "jobs/export" => ["xml"],
        "resources" => ["xml", "json"],
        "executions" => ["xml", "json"],
        "executions/running" => ["xml", "json"],
        "export" => ["xml", "json"],
        "history" => ["xml", "json"],
    ];

    function __construct($name = null)
    {
        $this->name = $name;
    }

    public function find($alt = "xml") {
        $response = HttpClient::get('/project/'.$this->name, $alt);
        return $response->getBody();
    }

    public function findAll($alt = "xml") {
        $response = HttpClient::get('/projects', $alt);
        return $response->getBody();
    }

    public function get($action, $alt = "xml") {
        if(array_key_exists($action, $this->actions)) {
            if(!in_array($alt, $this->actions[$action])) {
                throw new \Exception("Invalid Format: ". $alt);
            }
            $response = HttpClient::get('/project/'.$this->name. '/' .$action, $alt);
            return $response->getBody();
        } else {
            throw new \Exception("Action invalid.");
        }
    }

    public function resource($name, $alt = "xml") {
        $response = HttpClient::get('/project/'.$this->name. '/resource/' .$name, $alt);
        return $response->getBody();
    }
}