<?php

namespace app\controllers;

use app\src\actions\import\Start;
use app\src\base\controllers\WebController;

class ImportController extends WebController
{
    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'start' => [
                'class' => Start::class,
            ],
        ];
    }
}
