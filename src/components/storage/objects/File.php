<?php

namespace app\src\components\storage\objects;

use app\src\components\importer\interfaces\FileInterface;
use yii\base\BaseObject;

class File extends BaseObject implements FileInterface
{
    /**
     * {@inheritdoc}
     * @param string $baseName
     * @param string $dirPath
     */
    public function __construct(
        private readonly string $baseName,
        private readonly string $dirPath,
        $config = []
    )
    {
        parent::__construct($config);
    }

    public function getBaseName(): string
    {
        return $this->baseName;
    }

    /**
     * {@inheritdoc}
     */
    public function getPath(): string
    {
        return $this->dirPath . '/' . $this->getBaseName();
    }
}
