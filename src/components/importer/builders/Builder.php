<?php

namespace app\src\components\importer\builders;

use app\src\base\exceptions\UserException;
use yii\base\Model;
use yii\db\ActiveRecord;

abstract class Builder
{
    /**
     * @return Model
     */
    abstract public function getForm(): Model;

    /**
     * @param Model $form
     * @return ActiveRecord
     * @throws UserException
     */
    abstract public function build(Model $form): ActiveRecord;
}
