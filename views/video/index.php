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

    <?php if (User::getCurrentUserRole() != OvcRole::STUDENT && User::getCurrentUserRole()) : ?>
        <p class="text-right">
            <?= Html::a('Create Video', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php \yii\widgets\Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'course_id',
                'format' => 'raw',
                'value' => function($data) {
                    return \app\models\Course::findOne($data->course_id)->name;
                }
            ],
            'title',
            [
                'label' => 'Comments',
                'format' => 'raw',
                'value' => function ($data) {
                    return count(app\models\Comment::findAll(['video_id' => $data->id]));
                },
                    ],
                    [
                        'attribute' => 'created_at',
                        'format' => 'datetime',
                        'value' => function($data) {
                            return $data->created_at;
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => \app\components\OvcUtility::getVideoActionTemplate(),
                    ],
                ],
            ]);
            ?>
            <?php \yii\widgets\Pjax::end(); ?>

</div>