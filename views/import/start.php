<?php

use app\models\forms\ImportForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var ImportForm $form
 */

$this->title = 'Import';

?>
<div>
    <?php $formWidget = ActiveForm::begin([
        'action' => ['import/start'],
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $formWidget->field($form, 'file')->fileInput(); ?>

    <div class="form-group">
        <?= Html::submitButton('Import', ['class' => 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
