<?php

$db = require __DIR__ . '/database.php';
$kafka = require __DIR__ . '/kafka.php';

return [
    'id' => 'app',
    'basePath' => __DIR__,
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\controllers',
    'components' => [
        'db' => $db,
        'snowflake' => [
            'class' => 'xutl\snowflake\Snowflake',
            'workerId' => 0,
            'dataCenterId' => 0,
        ],
        'user' => [
            'identityClass' => 'app\models\User',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'request' => [
            'cookieValidationKey' => $_ENV['COOKIE_VALIDATION_KEY'],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'storage' => [
            'class' => 'app\src\components\storage\Component',
            'dirPath' => $_ENV['STORAGE_DIR_PATH'],
        ],
        'kafka' => $kafka,
    ],
];
