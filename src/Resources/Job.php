<?php

namespace Rundeck\Resources;

use Rundeck\HttpClient;

/**
 * Class Job
 * @package Rundeck\Resources
 */
class Job extends Resource
{

    /**
     * @var array
     */
    protected $actions = [
        "executions" => ["xml"],
        "input/files" => ["xml"],
        "info" => ["xml"],
    ];

    /**
     * @param HttpClient $client
     * @param string $name
     */
    public function __construct(HttpClient $client, $name = null)
    {
        $this->name = $name;
        $this->client = $client;
    }

    /**
     * @param string $alt
     * @return mixed
     */
    public function find($alt = "xml")
    {
        $response = $this->client->get('/job/'.$this->name, $alt);
        return $response;
    }
}
