<?php

namespace Rundeck\Controllers;

use Rundeck\HttpClient;

class TokenController
{

    public function __construct()
    {
    }

    public function findAll($alt = "xml")
    {
        $response = HttpClient::get('/tokens', $alt);
        return $response;
    }
}
