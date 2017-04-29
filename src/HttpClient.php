<?php

namespace Rundeck;


class HttpClient {

    public static $client;
    public static $endpoint;
    public static $authToken;
    public static $version;

    public static function setAuth($endpoint, $authToken, $version) {
        self::$endpoint = trim($endpoint, "/");
        self::$authToken = $authToken;
        self::$version = $version;
    }

    public static function getClient() {
        if(isset(self::$client)) {
            return self::$client;
        } else {
            self::$client = new \GuzzleHttp\Client();
            return self::$client;
        }
    }

    public static function get($uri, $alt) {
        $options = [];

        if($alt == "json") {
            $options = ['headers'=> ['Accept' => 'application/json']];
        }
        $uri = self::$endpoint. "/api/". self::$version .$uri."?authtoken=".self::$authToken;

        $response = self::getClient()->request('GET', $uri, $options);
        $xml = simplexml_load_string($response->getBody());
        $json = json_encode($xml);
        $data = json_decode($json,TRUE);

        return $data;
    }
}