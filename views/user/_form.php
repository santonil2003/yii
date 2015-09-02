<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Role;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'active')->dropdownList(
            array('0' => 'Inactive', '1' => 'Active'), ['prompt' => 'Select Role']
    );
    ?>

    <?=
    $form->field($model, 'role_id')->dropdownList(
            Role::find()->select(['name', 'id'])->indexBy('id')->column(), ['prompt' => 'Select Role']
    );
    ?>

    <?php
    /*
      echo $form->field($model, 'auth_key')->textInput(['maxlength' => true]);
      echo $form->field($model, 'access_token')->textInput(['maxlength' => true]);
      echo $form->field($model, 'created_at')->textInput();
      echo $form->field($model, 'modified_at')->textInput();
     */
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
