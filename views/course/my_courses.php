<?php

use yii\helpers\Html;

$this->title = 'My Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <?php foreach ($myCourses as $course): ?>
        <div class="row">
            <div class="col-md-2">
                <div class="thumbnail">
                    <img src="<?= Yii::getAlias('@web'); ?>/images/course.png" alt="course"/>
                    <div class="caption">
                        <h3><?= $course->code; ?></h3>
                        <p><?= $course->description; ?></p>
                        <p><?= $course->name; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>


    </div>

</div>
