<?php

namespace Rundeck\Resources;

use Rundeck\HttpClient;

class Job {

    private $name;

    private $actions = [
        "executions" => ["xml", "json"],
        "input/files" => ["xml", "json"],
        "info" => ["xml", "json"],
    ];

    function __construct($name = null)
    {
        $this->name = $name;
    }

    public function find($alt = "xml") {
        $response = HttpClient::get('/job/'.$this->name, $alt);
        return $response->getBody();
    }

    public function get($action, $alt = "xml") {
        if(array_key_exists($action, $this->actions)) {
            if(!in_array($alt, $this->actions[$action])) {
                throw new \Exception("Invalid Format: ". $alt);
            }
            $response = HttpClient::get('/job/'.$this->name. '/' .$action, $alt);
            return $response->getBody();
        } else {
            throw new \Exception("Action invalid.");
        }
    }
}