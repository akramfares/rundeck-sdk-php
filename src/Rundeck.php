<?php

namespace Rundeck;

class Rundeck
{
    /**
     * Create a new Client Instance
     */
    public function __construct($endpoint, $authToken, $version)
    {
        HttpClient::setAuth($endpoint, $authToken, $version);
    }

    public function __call($name, $arguments) {

        $className = "\\Rundeck\\Resources\\".ucfirst($name);
        if(class_exists($className)) {
            $resource = new \ReflectionClass($className);
            return $resource->newInstanceArgs($arguments);
        }
    }
}
