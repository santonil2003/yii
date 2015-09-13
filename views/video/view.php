<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\OvcVideoPlayerWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Video */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'course_id' => $model->course_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id, 'course_id' => $model->course_id], [
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
            'id',
            'course_id',
            'title',
            'description:html',
            ['label' => 'path', 'value' => OvcVideoPlayerWidget::widget(['path' => $model->path]), 'format' => 'raw'],
            'user_id',
            'created_at',
            'modified_at',
        ],
    ])
    ?>

</div>
