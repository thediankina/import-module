<?php

use yii\bootstrap5\Alert;

if (Yii::$app->session->hasFlash('error')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-danger'],
        'body' => Yii::$app->session->getFlash('error'),
    ]);
}
