<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use app\models\Course;

/* @var $this yii\web\View */
/* @var $model app\models\UserHasCourse */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'User Has Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-has-course-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'user_id' => $model->user_id, 'course_id' => $model->course_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'user_id' => $model->user_id, 'course_id' => $model->course_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['label' => 'User', 'value' => User::findOne($model->user_id)->first_name . ' ' . User::findOne($model->user_id)->last_name . ' ( ' . User::findOne($model->user_id)->username . ' )'],
            ['label' => 'Course', 'value' => Course::findOne($model->course_id)->code . ' ( ' . Course::findOne($model->course_id)->name . ' )'],
        ],
    ])
    ?>

</div>