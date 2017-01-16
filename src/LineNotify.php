<?php
namespace NotificationChannels\LineNotify;


use Exception;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use NotificationChannels\LineNotify\Exceptions\CouldNotSendNotification;

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


    /**
     * Get HttpClient.
     *
     * @return HttpClient
     */
    protected function httpClient()
    {
        return $this->http ?: $this->http = new HttpClient();
    }

    /**
     * Send text message.
     *
     * @param $params
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function send($params)
    {
        return $this->post('me/messages', $params);
    }

    /**
     * @param       $endpoint
     * @param array $params
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post($endpoint, array $params = [])
    {
        return $this->api($endpoint, ['json' => $params], 'POST');
    }

    /**
     * Send an API request and return response.
     *
     * @param        $endpoint
     * @param        $options
     * @param string $method
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws CouldNotSendNotification
     */
    protected function api($endpoint, $options, $method = 'GET')
    {
        if (empty($this->token)) {
            throw CouldNotSendNotification::lineNotifyTokenNotProvided('You must provide your LineNotify token to make any API requests.');
        }
        $url = "https://graph.facebook.com/v2.7/{$endpoint}?access_token={$this->token}";
        try {
            return $this->httpClient()->request($method, $url, $options);
        } catch (ClientException $exception) {
            throw CouldNotSendNotification::lineNotfyRespondedWithAnError($exception);
        } catch (Exception $exception) {
            throw CouldNotSendNotification::couldNotCommunicateWithLineNotify($exception);
        }
    }
}