<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <script>
            var base_url = "<?= Yii::getAlias('@web'); ?>";
        </script>
        <?php $this->head() ?>
    </head>
    <body>

        <?php $this->beginBody() ?>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <img src="<?= Yii::getAlias('@web'); ?>/images/video5.png" alt="ovc" style="float: left; max-height: 48px;"/><a class="navbar-brand" href="#"> <em>Online Visual Class</em></a>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <?php
                    echo Nav::widget([
                        'options' => ['class' => 'navbar-nav navbar-right'],
                        'items' => yii::$app->ovcUtility->getMainNavItems(),
                    ]);
                    ?>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <?php
                    echo Nav::widget([
                        'options' => ['class' => 'nav nav-sidebar'],
                        'items' => yii::$app->ovcUtility->getAdminNavItems(),
                    ]);
                    ?>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <?php
                    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
                        echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
                    }
                    ?>
                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>
                    <?= $content ?>
                </div>
            </div>

        </div>
        <?php $this->endBody() ?>
        <?= \app\components\OvcOverlayWidget::Widget(); ?>
    </body>
</html>
<?php $this->endPage() ?>
