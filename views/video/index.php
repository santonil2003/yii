<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use app\components\OvcRole;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VideoSearch */
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
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'courseName',
            'created_at',
            'commentCount',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => \app\components\OvcUtility::getVideoActionTemplate(),
            ],
        ],
    ]);
    ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>
