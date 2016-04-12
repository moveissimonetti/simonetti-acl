<?php

namespace Simonetti\ACL\Logger;

use Zend\ServiceManager\ServiceLocatorInterface;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Sender 
{

    protected $connection;
    protected $channel;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $this->openConnection($config);

        return $this;

    }

    public function sendMessage(array $message)
    {
        $msg = new AMQPMessage(\serialize($message));
        $this->channel->basic_publish($msg, '', 'logger');
    }

    protected function openConnection($config)
    {
        $this->connection = new AMQPStreamConnection($config['rabbit_mq']['host'], $config['rabbit_mq']['port'], $config['rabbit_mq']['username'], $config['rabbit_mq']['password']);
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare('logger', false, false, false, false);
    }

}