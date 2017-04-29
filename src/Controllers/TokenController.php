<?php

namespace Rundeck\Controllers;


use Rundeck\HttpClient;

class TokenController {

    function __construct()
    {

    }

    public function findAll() {
        $response = HttpClient::get('/tokens');
        return $response;
    }
}