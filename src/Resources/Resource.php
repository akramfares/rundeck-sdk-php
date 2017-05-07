<?php

namespace Rundeck\Resources;

use Rundeck\HttpClient;

abstract class Resource
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * @var array
     */
    protected $actions;

    /**
     * Get resource action
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
            $response = $this->client->get('/'. strtolower(get_class($this)) .'/'.$this->name. '/' .$action, $alt);
            return $response;
        } else {
            throw new \Exception("Invalid Action: ". $action);
        }
    }
}
