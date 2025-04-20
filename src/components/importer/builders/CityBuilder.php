<?php

namespace app\src\components\importer\builders;

use app\models\db\City;
use app\src\base\exceptions\UserException;
use app\src\components\importer\models\forms\CityForm;
use yii\base\Model;

class CityBuilder extends Builder
{
    /**
     * {@inheritdoc}
     * @return CityForm
     */
    public function getForm(): CityForm
    {
        return new CityForm();
    }

    /**
     * {@inheritdoc}
     * @param CityForm $form
     * @return City
     */
    public function build(Model $form): City
    {
        $model = $form->id ? City::findOne($form->id) : new City();

        if ($model === null) {
            throw new UserException(['The city not found by ID:' . $form->id]);
        }

        $model->setAttributes($form->attributes, false);

        return $model;
    }
}
