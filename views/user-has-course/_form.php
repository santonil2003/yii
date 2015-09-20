<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use app\models\Course;

/* @var $this yii\web\View */
/* @var $model app\models\UserHasCourse */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="user-has-course-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'user_id')->dropdownList(
            User::find()->select(['CONCAT(first_name," ",last_name, " ( ", username," )") as name', 'id'])->indexBy('id')->column(), ['prompt' => 'Select User']
    );
    ?>

    <?=
    $form->field($model, 'course_id')->dropdownList(
            Course::find()->select(['CONCAT(code," ( ", name," )") as name', 'id'])->indexBy('id')->column(), ['prompt' => 'Select Course']
    );
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    var user_has_course_form_url = '<?= \yii\helpers\Url::to(['user-has-course/get-unassigned-course']) ?>';
</script>
