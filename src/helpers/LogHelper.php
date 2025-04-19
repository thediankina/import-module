<?php

namespace app\src\helpers;

use Throwable;
use Yii;

class LogHelper
{
    public static function exception(Throwable $e): void
    {
        Yii::error($e->getMessage() . "\n" . $e->getTraceAsString());
    }
}
