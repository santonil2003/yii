<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use app\components\OvcRole;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (User::getCurrentUserRole() != OvcRole::STUDENT && User::getCurrentUserRole()) : ?>
        <p>
            <?= Html::a('Create Video', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'course_id',
            'title',
            'description:ntext',
            'path',
            // 'user_id',
            // 'created_at',
            // 'modified_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => \app\components\OvcUtility::getVideoActionTemplate(),
            ],
        ],
    ]);
    ?>

</div>
