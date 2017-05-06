<?php

namespace Rundeck\Resources;

use Rundeck\HttpClient;

/**
 * Class Execution /api/V/execution/
 * @package Rundeck\Resources
 */
class Execution
{
    /**
     * @var null|string
     */
    private $name;

    /**
     * @var HttpClient
     */
    private $client;

    private $actions = [
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

    /**
     * Get Execution action
     * @param $action
     * @param string $alt xml|json
     * @return array
     * @throws \Exception
     */
    public function get($action, $alt = "xml")
    {
        if (array_key_exists($action, $this->actions)) {
            if (!in_array($alt, $this->actions[$action])) {
                throw new \Exception("Invalid Format: ". $alt);
            }
            $response = $this->client->get('/execution/'.$this->name. '/' .$action, $alt);
            return $response;
        } else {
            throw new \Exception("Action invalid.");
        }
    }
}
