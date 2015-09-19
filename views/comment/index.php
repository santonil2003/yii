<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="text-right">
        <?= Html::a('Create Comment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php \yii\widgets\Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'text:html',
            'videoTitle',
            'username',
            'created_at',
//            [
//                'attribute' => 'created_at',
//                'format' => 'datetime',
//                'value' => function($data) {
//                    return $data->created_at;
//                }
//            ],
            // 'modified_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>
