<?php

namespace Rundeck\Controllers;

use Rundeck\HttpClient;

class SystemController
{

    private $actions = [
        "info",
        "logstorage",
        "logstorage/incomplete"
    ];

    public function get($action, $alt = "xml")
    {
        if (in_array($action, $this->actions)) {
            $response = HttpClient::get('/system/'. $action, $alt);
            return $response;
        } else {
            throw new \Exception("Action invalid.");
        }
    }
}
