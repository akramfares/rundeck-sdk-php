<?php

namespace Rundeck\Controllers;

use Rundeck\HttpClient;

class ExecutionController {

    private $name;

    private $actions = [
        "abort" => ["xml"],
        "output" => ["xml"],
        "output/state" => ["xml"],
        "state" => ["xml"],
        "input/files" => ["xml"],
    ];

    function __construct($name = null)
    {
        $this->name = $name;
    }

    public function find($alt = "xml") {
        $response = HttpClient::get('/execution/'.$this->name, $alt);
        return $response;
    }

    public function get($action, $alt = "xml") {
        if(array_key_exists($action, $this->actions)) {
            if(!in_array($alt, $this->actions[$action])) {
                throw new \Exception("Invalid Format: ". $alt);
            }
            $response = HttpClient::get('/execution/'.$this->name. '/' .$action, $alt);
            return $response;
        } else {
            throw new \Exception("Action invalid.");
        }
    }
}