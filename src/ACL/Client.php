<?php

namespace Simonetti\ACL;

use Zend\Http\Client as HttpClient;
use Simonetti\ACL\Connection\API;
use Simonetti\ACL\Logger\Sender;
use Zend\Cache\StorageFactory;

class Client
{

    static public function getInstance($options = null)
    {

        // dados do arquivo de configuracao
        $config = require(__DIR__ . '/../../config/app.config.php');

        if ($options) {
            $config = \array_merge_recursive($config, $options);
        }

        // instancia do HTTPClient
        $httpClient = new HttpClient();

        // instanciando o cache
        $cache = StorageFactory::factory($config['cache']);

        // instanciando o logger
        $logger = new Sender($config);

        $api = new API($httpClient, $config, $cache, $logger);

        return $api;

    }


}