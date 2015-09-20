<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Comment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-view">
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'text:ntext',
            'video_id',
            'user_id',
            'created_at',
            'modified_at',
        ],
    ])
    ?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'video_id' => $model->video_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id, 'video_id' => $model->video_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

</div>
