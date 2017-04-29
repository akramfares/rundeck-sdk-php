<?php

namespace Rundeck\Resources;


use Rundeck\HttpClient;

class System {

    private $actions = [
        "info",
        "logstorage",
        "logstorage/incomplete"
    ];

    public function get($action, $alt = "xml") {
        if(in_array($action, $this->actions)) {
            $response = HttpClient::get('/system/'. $action, $alt);
            return $response->getBody();
        } else {
            throw new \Exception("Action invalid.");
        }
    }
}