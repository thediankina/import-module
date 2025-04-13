<?php

namespace app\src\components\storage;

use app\src\components\storage\objects\File;
use Yii;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;

class Component extends \yii\base\Component
{
    private $dirPath;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->dirPath = Yii::getAlias($this->dirPath);
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return File
     * @throws ServerErrorHttpException
     */
    public function save(UploadedFile $uploadedFile): File
    {
        $file = new File(
            name: 'file_' . time(),
            extension: $uploadedFile->getExtension(),
            dirPath: $this->dirPath,
        );

        if (!$uploadedFile->saveAs($file->getPath())) {
            throw new ServerErrorHttpException('The attempt to save uploaded file failed.');
        }

        return $file;
    }
}
