<?php

namespace app\models\forms;

use yii\base\Model;

class ImportForm extends Model
{
    public $file;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [
                ['file'],
                'file',
                'skipOnEmpty' => false,
                'extensions' => ['csv'],
                'maxSize' => 5 * 1024 * 1024,
                'checkExtensionByMimeType' => false,
                'mimeTypes' => ['text/csv', 'text/plain'],
            ],
        ];
    }
}
