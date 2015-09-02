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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'first_name',
            'last_name',
            'username',
            //'password',
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
            // 'auth_key',
            // 'access_token',
            // 'created_at',
            // 'modified_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
