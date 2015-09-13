<div class="row">
    <?php foreach ($latestVideos as $video): ?>
        <div class="col-md-2">
            <div class="thumbnail">
                <img src="<?= Yii::getAlias('@web'); ?>/images/video.png" alt="video"/>
                <a href="<?= yii\helpers\Url::to(['video/play', 'id' => $video->id]) ?>">
                    <div class="caption">
                        <h4 class="text-center">
                            <b><?php echo $video->title ?></b>
                        </h4>
                    </div>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

