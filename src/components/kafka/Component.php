<?php

namespace app\src\components\kafka;

use app\src\components\kafka\objects\Queue;
use Yii;
use yii\base\InvalidConfigException;

class Component extends \yii\base\Component
{
    private $queues = [];

    /**
     * {@inheritdoc}
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        foreach ($this->queues as $topic => $config) {
            $this->queues[$topic] = Yii::createObject([
                'class' => Queue::class,
                ...$config
            ]);
        }
    }

    public function getQueue(string $topic): Queue
    {
        return $this->queues[$topic];
    }
}
