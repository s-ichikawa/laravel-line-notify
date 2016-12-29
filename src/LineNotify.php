<?php
namespace NotificationChannels\LineNotify;


use GuzzleHttp\Client as HttpClient;

class LineNotify
{
    /**
     * @var null|string token.
     */
    protected $token;

    /**
     * @var HttpClient
     */
    protected $http;


    /**
     * LineNotify constructor.
     * @param null $token
     * @param HttpClient $httpClient
     */
    public function __construct($token = null, HttpClient $httpClient = null)
    {
        $this->token = $token;

        $this->http = $httpClient;
    }


}