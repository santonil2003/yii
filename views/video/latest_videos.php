<?php

use app\components\OvcLatestVideoWidget;

$this->title = 'Latest Videos';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= OvcLatestVideoWidget::widget(); ?>



