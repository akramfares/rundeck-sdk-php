<?php

namespace Rundeck;

class Rundeck
{
    /**
     * @var HttpClient
     */
    private $client;

    /**
     * Create a new Rundeck Instance
     */
    public function __construct($endpoint, $authToken, $version)
    {
        $this->client = new HttpClient();
        $this->client->setAuth($endpoint, $authToken, $version);
    }

    /**
     * @param HttpClient $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @param $name
     * @param $arguments
     * @return object
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        $className = "\\Rundeck\\Resources\\".ucfirst($name);
        if (class_exists($className)) {
            array_unshift($arguments, $this->client);
            $resource = new \ReflectionClass($className);
            return $resource->newInstanceArgs($arguments);
        } else {
            throw new \Exception("This resource doesn't exist.");
        }
    }
}
