<?php

namespace Rundeck\Resources;

use Rundeck\HttpClient;

/**
 * Class Execution /api/V/execution/
 * @package Rundeck\Resources
 */
class Execution extends Resource
{

    protected $actions = [
        "abort" => ["xml"], // /api/V/execution/[ID]/abort
        "output" => ["xml"], // /api/V/execution/[ID]/output
        "output/state" => ["xml"], // /api/V/execution/[ID]/output/state
        "state" => ["xml"], // /api/V/execution/[ID]/state
        "input/files" => ["xml"], // /api/V/execution/[ID]/input/files
    ];

    /**
     * @param HttpClient $client
     * @param string $name : Execution ID
     */
    public function __construct(HttpClient $client, $name = null)
    {
        $this->name = $name;
        $this->client = $client;
    }

    /**
     * Find execution info by ID
     * @param string $alt
     * @return mixed
     */
    public function find($alt = "xml")
    {
        $response = $this->client->get('/execution/'.$this->name, $alt);
        return $response;
    }
}
