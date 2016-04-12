<?php

namespace Simonetti\ACL;

use Zend\Http\Client as HttpClient;
use Simonetti\ACL\Connection\API;

class Client
{

    static public function getInstance($options = null)
    {

        # dados do arquivo de configuracao
        $config = require(__DIR__ . '/../../config/app.config.php');

        if ($options) {
            $config['simonetti_api'] = $options;
        }

        # instancia do HTTPClient
        $httpClient = new HttpClient();

        $api = new API($httpClient, $config);

        return $api;

    }


}