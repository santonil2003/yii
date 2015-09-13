<?php

use yii\helpers\Html;

$this->title = 'My Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">
    <?php foreach ($myCourses as $course): ?>

        <div class="panel panel-default">
            <div class="panel-body">
                <div data-example-id="media-alignment">
                    <div class="media">
                        <div class="media-left">
                            <img src="<?= Yii::getAlias('@web'); ?>/images/course.png" alt="course" style="max-width: 65px;"/>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><?= $course->code; ?></h4>
                            <p><?= $course->name; ?></p>
                            <?= $course->description; ?>
                            <p class="text-right"><button type="button" class="btn btn-primary btn-xs">Videos</button></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
