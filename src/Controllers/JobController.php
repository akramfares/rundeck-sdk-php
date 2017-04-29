<?php

namespace Rundeck\Controllers;

use Rundeck\HttpClient;

class JobController
{

    private $name;

    private $actions = [
        "executions" => ["xml"],
        "input/files" => ["xml"],
        "info" => ["xml"],
    ];

    public function __construct($name = null)
    {
        $this->name = $name;
    }

    public function find($alt = "xml")
    {
        $response = HttpClient::get('/job/'.$this->name, $alt);
        return $response;
    }

    public function get($action, $alt = "xml")
    {
        if (array_key_exists($action, $this->actions)) {
            if (!in_array($alt, $this->actions[$action])) {
                throw new \Exception("Invalid Format: ". $alt);
            }
            $response = HttpClient::get('/job/'.$this->name. '/' .$action, $alt);
            return $response;
        } else {
            throw new \Exception("Action invalid.");
        }
    }
}
