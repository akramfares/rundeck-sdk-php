<?php

namespace Rundeck\Resources;

use Rundeck\HttpClient;

/**
 * Class Job
 * @package Rundeck\Resources
 */
class Job
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @var array
     */
    private $actions = [
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

    /**
     * Get Job action
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
            $response = $this->client->get('/job/'.$this->name. '/' .$action, $alt);
            return $response;
        } else {
            throw new \Exception("Action invalid.");
        }
    }
}
