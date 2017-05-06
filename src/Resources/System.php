<?php

namespace Rundeck\Resources;

use Rundeck\HttpClient;

/**
 * Class System /api/V/system/
 * @package Rundeck\Resources
 */
class System
{
    /**
     * @var null
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
        "info", // /api/V/system/info
        "logstorage", // /api/V/system/logstorage
        "logstorage/incomplete" // /api/V/system/logstorage/incomplete
    ];

    /**
     * @param HttpClient $client
     * @param null $name
     */
    public function __construct(HttpClient $client, $name = null)
    {
        $this->name = $name;
        $this->client = $client;
    }

    /**
     * Get System action
     * @param $action
     * @param string $alt xml|json
     * @return array
     * @throws \Exception
     */
    public function get($action, $alt = "xml")
    {
        if (in_array($action, $this->actions)) {
            $response = $this->client->get('/system/'. $action, $alt);
            return $response;
        } else {
            throw new \Exception("Action invalid.");
        }
    }
}
