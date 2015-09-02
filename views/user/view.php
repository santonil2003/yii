<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Role;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'role_id' => $model->role_id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id, 'role_id' => $model->role_id], [
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
            'first_name',
            'last_name',
            'username',
            'password',
            'email:email',
            ['label' => 'Active', 'value' => ($model->active == 1) ? 'Active' : 'Inactive'],
            ['label' => 'Role', 'value' => Role::findOne($model->role_id)->name],
            'auth_key',
            'access_token',
            'created_at',
            'modified_at',
        ],
    ])
    ?>

</div>
