<?php

namespace Rundeck\Resources;


use Rundeck\HttpClient;

class Token {

    function __construct()
    {

    }

    public function findAll() {
        $response = HttpClient::get('/tokens');
        return $response->getBody();
    }
}