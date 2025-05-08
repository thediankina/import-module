<?php

namespace app\src\components\storage\interfaces;

use app\src\components\storage\objects\File;
use yii\web\UploadedFile;

interface StorageInterface
{
    /**
     * @param UploadedFile $uploadedFile
     * @return File|null
     */
    public function save(UploadedFile $uploadedFile): ?File;

    /**
     * @param string $fileBaseName
     * @return File|null
     */
    public function get(string $fileBaseName): ?File;
}
