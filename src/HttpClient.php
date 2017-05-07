<?php

namespace Rundeck;

/**
 * Class HttpClient
 * @package Rundeck
 */
class HttpClient
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;
    /**
     * @var string
     */
    private $endpoint;
    /**
     * @var string
     */
    private $authToken;
    /**
     * @var int
     */
    private $version;

    /**
     * @param $endpoint
     * @param $authToken
     * @param $version
     */
    public function setAuth($endpoint, $authToken, $version)
    {
        $this->endpoint = trim($endpoint, "/");
        $this->authToken = $authToken;
        $this->version = $version;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getClient()
    {
        if (isset($this->client)) {
            return $this->client;
        } else {
            $this->client = new \GuzzleHttp\Client();
            return $this->client;
        }
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @param $uri
     * @param $alt
     * @return array
     */
    public function get($uri, $alt)
    {
        $options = ['headers'=> ['Accept' => 'application/xml']];

        if ($alt == "json") {
            $options = ['headers'=> ['Accept' => 'application/json']];
        }
        $uri = $this->endpoint. "/api/". $this->version .$uri."?authtoken=".$this->authToken;

        $response = $this->getClient()->request('GET', $uri, $options);
        $xml = simplexml_load_string($response->getBody());
        $json = json_encode($xml);
        $data = json_decode($json, true);

        return $data;
    }
}
