<?php

namespace Simonetti\ACL;

use Zend\Http\Client as HttpClient;
use Simonetti\ACL\Connection\API;
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

        $cache = StorageFactory::factory($config['cache']);

        $api = new API($httpClient, $config, $cache);

        return $api;

    }


}