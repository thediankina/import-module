<?php

use yii\bootstrap5\Alert;

if (Yii::$app->session->hasFlash('success')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-success'],
        'body' => Yii::$app->session->getFlash('success')
    ]);
}
