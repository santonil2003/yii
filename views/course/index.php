<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use app\components\OvcRole;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">
    <?php if (User::getCurrentUserRole() == OvcRole::ADMIN && User::getCurrentUserRole()) : ?>
        <p class="text-right">
            <?= Html::a('Create Course', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'code',
            'name',
            //'description:html',
            'created_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => \app\components\OvcUtility::getCourseActionTemplate(),
            ],
        ],
    ]);
    ?>

</div>
