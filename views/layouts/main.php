<?php

use app\assets\AppAsset;
use yii\bootstrap5\NavBar;
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
    <?php NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top'],
    ]); ?>
    <?php NavBar::end(); ?>
</header>

<main class="flex-shrink-0">
    <div class="container">
        <?= $content ?>
    </div>
</main>

<footer class="mt-auto py-3 bg-light">
    <div class="container">
        Diana Galiulina, 2025
    </div>
</footer>

<?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>
