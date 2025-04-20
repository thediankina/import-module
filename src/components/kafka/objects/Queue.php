<?php

namespace app\src\components\kafka\objects;

use app\src\helpers\LogHelper;
use longlang\phpkafka\Consumer\Consumer;
use longlang\phpkafka\Consumer\ConsumerConfig;
use longlang\phpkafka\Producer\Producer;
use longlang\phpkafka\Producer\ProducerConfig;
use yii\base\InvalidConfigException;
use yii\base\NotSupportedException;

class Queue extends \yii\queue\cli\Queue
{
    public $broker;
    public $topic;
    public $groupId;

    /**
     * {@inheritdoc}
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        $this->messageHandler = function ($id, $message, $ttr = null, $attempt = null) {
            list($job, $error) = $this->unserializeMessage($message);

            if ($error !== null) {
                LogHelper::exception($error);
            }

            $job?->execute($this);
        };
    }

    /**
     * {@inheritdoc}
     */
    protected function pushMessage($message, $ttr, $delay, $priority): string
    {
        $config = new ProducerConfig();
        $config->setBootstrapServer($this->broker);
        $config->setUpdateBrokers(true);
        $config->setAcks(-1);

        $producer = new Producer($config);
        $key = uniqid('', true);
        $producer->send($this->topic, $message, $key);

        return $key;
    }

    public function listen()
    {
        $config = new ConsumerConfig();
        $config->setBroker($this->broker);
        $config->setTopic($this->topic);
        $config->setGroupId($this->groupId);

        $consumer = new Consumer($config);

        while (true) {
            $message = $consumer->consume();

            if ($message !== null) {
                call_user_func($this->messageHandler, $message->getKey(), $message->getValue());
                $consumer->ack($message);
            } else {
                sleep(15);
            }
        }
    }

    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public function status($id): int
    {
        throw new NotSupportedException(__METHOD__ . ' is not supported.');
    }
}
