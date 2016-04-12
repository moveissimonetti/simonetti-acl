<?php

namespace Simonetti\ACL\Connection;

use Zend\Http\Client as HttpClient;
use Zend\Http\Request as HttpRequest;
use Simonetti\ACL\Exception\SimonettiACLException;

class API
{

    /**
     * @var HttpClient
     */
    private $http;

    /**
     * @var array
     */
    private $config;

    public function __construct(HttpClient $http, array $config)
    {

        if (!isset($config['simonetti_api']['endpoint'])) {
            throw new SimonettiACLException('A URL da API é obrigatória. Favor checar arquivo de configuração');
        }

        $this->config = $config;

        $this->http = $http;

    }

    public function auth($username, $password)
    {
        try {
            $this->http->setUri($this->config['simonetti_api']['endpoint']['oauth'])
                ->setMethod(HttpRequest::METHOD_POST)
                ->setHeaders([
                    'Content-Type' => 'application/json'
                ]);

            $response = $this->http->setRawBody(\json_encode([
                'client_id' => $this->config['simonetti_api']['credentials']['client_id'],
                'client_secret' => $this->config['simonetti_api']['credentials']['client_secret'],
                'grant_type' => $this->config['simonetti_api']['credentials']['grant_type'],
                'username' => $username,
                'password' => $password
            ]))->send()->getBody();

            return \json_decode($response, true);

        } catch (SimonettiACLException $e) {
            return [
                'success' => 0,
                'error' => $e->getMessage(),
                'errorCode' => 'FAILED_AUTH'
            ];
        }
    }

    public function isAllowed($resource, $token)
    {
        try {
            $this->http->setUri(sprintf($this->config['simonetti_api']['endpoint']['validate'], $this->config['simonetti_api']['credentials']['client_id']))
                ->setMethod(HttpRequest::METHOD_HEAD);

            // montando headers
            $statusCode = $this->http->setHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
                'x-resource' => $resource,
            ])->send()->getStatusCode();

            return ($statusCode === 200);

        } catch (SimonettiACLException $e) {
            # TODO aplicar envio do erro para LOG
            return false;
        }
    }


}