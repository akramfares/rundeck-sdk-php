<?php

namespace Rundeck\Resources;

use Rundeck\HttpClient;

/**
 * Class System /api/V/system/
 * @package Rundeck\Resources
 */
class System extends Resource
{

    /**
     * @var array
     */
    protected $actions = [
        "info" => ["xml"], // /api/V/system/info
        "logstorage" => ["xml"], // /api/V/system/logstorage
        "logstorage/incomplete" => ["xml"] // /api/V/system/logstorage/incomplete
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
}
