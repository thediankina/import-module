<?php

namespace app\src\components\storage;

use app\src\components\storage\interfaces\StorageInterface;
use app\src\components\storage\objects\File;
use Yii;
use yii\base\Component;
use yii\web\UploadedFile;

class Disk extends Component implements StorageInterface
{
    public string $dirPath;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->dirPath = Yii::getAlias($this->dirPath);
    }

    /**
     * {@inheritdoc}
     */
    public function save(UploadedFile $uploadedFile): ?File
    {
        $file = new File(
            baseName: 'file_' . time() . '.' . $uploadedFile->getExtension(),
            dirPath: $this->dirPath
        );

        if (!$uploadedFile->saveAs($file->getPath())) {
            return null;
        }

        return $file;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $fileBaseName): ?File
    {
        $file = new File(
            baseName: $fileBaseName,
            dirPath: $this->dirPath
        );

        if (!file_exists($file->getPath())) {
            return null;
        }

        return $file;
    }
}
