<?php

namespace app\src\components\storage\objects;

use app\src\components\importer\interfaces\FileInterface;
use yii\base\BaseObject;

class File extends BaseObject implements FileInterface
{
    /**
     * {@inheritdoc}
     * @param string $name
     * @param string $extension
     * @param string $dirPath
     */
    public function __construct(
        private readonly string $name,
        private readonly string $extension,
        private readonly string $dirPath,
        $config = []
    )
    {
        parent::__construct($config);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function getBaseName(): string
    {
        return $this->getName() . '.' . $this->getExtension();
    }

    /**
     * {@inheritdoc}
     */
    public function getPath(): string
    {
        return $this->dirPath . '/' . $this->getBaseName();
    }
}
