<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use app\models\Role;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <?php \yii\widgets\Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'first_name',
            'last_name',
            'email:email',
            [
                'attribute' => 'active',
                'format' => 'raw',
                'value' => function($data) {
                    return User::getActiveLabel($data->active);
                }
            ],
            [
                'attribute' => 'role_id',
                'format' => 'raw',
                'value' => function($data) {
                    return Role::findOne($data->role_id)->name;
                }
            ],
            'created_at',
        ],
    ]);
    ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>
