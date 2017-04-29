<?php

namespace Rundeck\Resources;

use Rundeck\HttpClient;

class Execution {

    private $name;

    private $actions = [
        "abort" => ["xml", "json"],
        "output" => ["xml", "json"],
        "output/state" => ["xml", "json"],
        "state" => ["xml", "json"],
        "input/files" => ["xml", "json"],
    ];

    function __construct($name = null)
    {
        $this->name = $name;
    }

    public function find($alt = "xml") {
        $response = HttpClient::get('/execution/'.$this->name, $alt);
        return $response->getBody();
    }

    public function get($action, $alt = "xml") {
        if(array_key_exists($action, $this->actions)) {
            if(!in_array($alt, $this->actions[$action])) {
                throw new \Exception("Invalid Format: ". $alt);
            }
            $response = HttpClient::get('/execution/'.$this->name. '/' .$action, $alt);
            return $response->getBody();
        } else {
            throw new \Exception("Action invalid.");
        }
    }
}