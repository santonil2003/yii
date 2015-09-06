<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use app\models\Course;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Has Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-has-course-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User Has Course', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function($data) {
                    return User::findOne($data->user_id)->first_name . ' ' . User::findOne($data->user_id)->last_name . '( ' . User::findOne($data->user_id)->username . ' )';
                }
            ],
            [
                'attribute' => 'course_id',
                'format' => 'raw',
                'value' => function($data) {
                    return Course::findOne($data->course_id)->code . '( ' . Course::findOne($data->course_id)->name . ' )';
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
