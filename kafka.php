<?php

return [
    'class' => 'app\src\components\kafka\Component',
    'queues' => [
        [
            'broker' => $_ENV['KAFKA_BROKER'],
            'topic' => 'importer',
            'groupId' => 'importer_group',
        ],
    ],
];
