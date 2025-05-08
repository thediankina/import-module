<?php

use app\models\forms\ImportForm;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

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
