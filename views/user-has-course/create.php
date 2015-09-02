<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserHasCourse */

$this->title = 'Create User Has Course';
$this->params['breadcrumbs'][] = ['label' => 'User Has Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-has-course-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
