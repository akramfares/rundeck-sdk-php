<?php

namespace Rundeck\Controllers;

use Rundeck\HttpClient;

class ProjectController {

    private $name;

    private $actions = [
        "jobs" => ["xml"],
        "jobs/export" => ["xml"],
        "resources" => ["xml"],
        "executions" => ["xml"],
        "executions/running" => ["xml"],
        "export" => ["xml"],
        "history" => ["xml"],
    ];

    function __construct($name = null)
    {
        $this->name = $name;
    }

    public function find($alt = "xml") {
        $response = HttpClient::get('/project/'.$this->name, $alt);
        return $response;
    }

    public function findAll($alt = "xml") {
        $response = HttpClient::get('/projects', $alt);
        return $response;
    }

    public function get($action, $alt = "xml") {
        if(array_key_exists($action, $this->actions)) {
            if(!in_array($alt, $this->actions[$action])) {
                throw new \Exception("Invalid Format: ". $alt);
            }
            $response = HttpClient::get('/project/'.$this->name. '/' .$action, $alt);
            return $response;
        } else {
            throw new \Exception("Action invalid.");
        }
    }

    public function resource($name, $alt = "xml") {
        $response = HttpClient::get('/project/'.$this->name. '/resource/' .$name, $alt);
        return $response;
    }
}