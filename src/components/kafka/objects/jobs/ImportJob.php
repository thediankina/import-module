<?php

namespace app\src\components\kafka\objects\jobs;

use app\src\components\importer\enums\BuilderType;
use Yii;
use yii\base\BaseObject;
use yii\base\Exception;
use yii\queue\JobInterface;

class ImportJob extends BaseObject implements JobInterface
{
    public BuilderType $builderType;
    public string $fileBaseName;

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function execute($queue)
    {
        $builder = $this->builderType->builder();
        $file = Yii::$app->storage->get($this->fileBaseName);

        if ($file === null) {
            throw new Exception('The file does not exists.');
        }

        Yii::$app->importer->import($file, $builder);
    }
}
