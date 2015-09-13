<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Course;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model app\models\Video */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?=
    $form->field($model, 'course_id')->dropdownList(
            Course::find()->select(['name', 'id'])->indexBy('id')->column(), ['prompt' => 'Select Course']
    );
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'description')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'clientOptions' => [
            'menubar' => 'false',
        ]
    ]);
    ?>

    <?= $form->field($model, 'path')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
