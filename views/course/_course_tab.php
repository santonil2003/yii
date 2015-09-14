
<div data-example-id="media-alignment" class="ovc-tab-body">
    <div class="media">
        <div class="media-left">
            <img src="<?= Yii::getAlias('@web'); ?>/images/course.png" alt="course" style="max-width: 65px;"/>
        </div>
        <div class="media-body">
            <h4><?= $course->name; ?></h4>
            <?= $course->description; ?>
            <p class="text-right"><button type="button" class="btn btn-primary btn-xs">Videos</button></p>
        </div>
    </div>
</div>
