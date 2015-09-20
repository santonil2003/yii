<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use app\models\Course;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserHasCourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Has Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-has-course-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="text-right">
        <?= Html::a('Create User Has Course', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php \yii\widgets\Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'course.name',
            'user.username',
            'user.role.name',
            'user.first_name',
            'user.last_name',
            'user.email',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => \app\components\OvcUtility::getUserHasCourseActionTemplate(),
            ],
        ],
    ]);
    ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>
