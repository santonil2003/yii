<div class="row ovc-latest-video">
    <?php foreach ($latestVideos as $video): ?>
        <div class="col-sm-4 col-md-3">
            <div class="thumbnail">
                <?= \app\components\OvcVideoPlayerWidget::widget(['path' => $video->path]); ?>
                <div class="caption">
                    <h4><?php echo $video->title ?></h4>
                    <p class="text-right"><a class="btn btn-primary btn-xs" href="<?= yii\helpers\Url::to(['video/view', 'id' => $video->id, 'course_id' => $video->course_id]) ?>">view</a></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>