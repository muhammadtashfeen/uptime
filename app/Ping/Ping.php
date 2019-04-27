<?php

namespace App\Ping;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;

class Ping
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var int
     */
    protected $responseCode;

    /**
     * @var int
     */
    protected $responseTime;

    /**
     * @var string
     */
    protected $serverType;

    /**
     * @var int
     */
    protected $timeout = 5;

    /**
     * @var bool
     */
    protected $allowRedirects = true;

    /**
     * @var arr
     */
    protected $dns;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => $this->timeout,
            'allow_redirects' => $this->allowRedirects,
        ]);
    }

    public function check($url)
    {
        try {
            $response = $this->client->get($url);
            $this->responseCode = $response->getStatusCode();
        } catch(ClientException $e) {
            $response = $e->getResponse();
            $this->responseCode = $response->getStatusCode();
        } catch(ConnectException $e) {
            $this->responseCode = $e->getCode();
        } catch(ServerException $e) {
            $this->responseCode = $e->getCode();
        }

        return $this->responseCode;
    }

    public function pingWithResponseTime($url)
    {

        try {
            $requestStartTime = microtime(1);
            $response = $this->client->get($url);
            $requestEndTime = microtime(1);
            $this->responseTime = $requestEndTime - $requestStartTime;//Response time
            $this->responseCode = $response->getStatusCode();
            $this->serverType   = $response->getHeader('server')[0];
        } catch(ClientException $e) {
            $response = $e->getResponse();
            $this->responseCode = $response->getStatusCode();
        } catch(ConnectException $e) {
            $this->responseCode = $e->getCode();
        } catch(ServerException $e) {
            $this->responseCode = $e->getCode();
        }

        return [
            'code'         => $this->responseCode,
            'responseTime' => $this->responseTime,
            'serverType'   => $this->serverType
        ];
    }
}