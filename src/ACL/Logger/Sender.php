<?php

namespace Simonetti\ACL\Logger;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Sender
{

    protected $connection;
    protected $channel;

    public function __construct(array $config)
    {
        $this->openConnection($config);
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