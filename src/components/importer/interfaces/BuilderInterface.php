<?php

namespace app\src\components\importer\interfaces;

use app\src\base\exceptions\UserException;
use yii\base\Model;
use yii\db\ActiveRecord;

interface BuilderInterface
{
    /**
     * @return Model
     */
    public function getForm(): Model;

    /**
     * @param Model $form
     * @return ActiveRecord
     * @throws UserException
     */
    public function build(Model $form): ActiveRecord;
}
