<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var string $content
 */

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
</head>

<body class="d-flex flex-column h-100">
<?php $this->beginBody(); ?>

<header>
    <?= $this->render('header'); ?>
</header>

<main class="flex-shrink-0">
    <div class="container">
        <?= $this->render('alerts/success'); ?>
        <?= $this->render('alerts/error'); ?>
        <?= $content ?>
    </div>
</main>

<footer class="mt-auto py-3 bg-light">
    <?= $this->render('footer'); ?>
</footer>

<?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>
