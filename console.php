<?php

$db = require __DIR__ . '/database.php';
$kafka = require __DIR__ . '/kafka.php';

return [
    'id' => 'app-console',
    'basePath' => __DIR__,
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'db' => $db,
        'snowflake' => [
            'class' => 'xutl\snowflake\Snowflake',
            'workerId' => 0,
            'dataCenterId' => 0,
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
        'storage' => [
            'class' => 'app\src\components\storage\Disk',
            'dirPath' => $_ENV['STORAGE_DIR_PATH'],
        ],
        'importer' => [
            'class' => 'app\src\components\importer\Component',
            'readerType' => \PhpOffice\PhpSpreadsheet\IOFactory::READER_CSV,
        ],
        'kafka' => $kafka,
    ],
];
