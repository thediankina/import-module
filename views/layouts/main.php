<?php

use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var string $content
 */

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <?= Html::csrfMetaTags(); ?>
    <title><?= Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
</head>

<body>
<?php $this->beginBody(); ?>

<header>Import module</header>

<?= $content ?>

<footer>Diana Galiulina, 2025</footer>

<?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>
