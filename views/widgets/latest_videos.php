<?php
use yii\helpers\Url;
?>
<div class="row">
<?php foreach ($latestVideos as $video): ?>
        <div class="col-sm-4 col-md-3">
            <div class="thumbnail">
                <img src="<?php echo Url::base() . '/' . $video->path ?>" alt="">
                <div class="caption">
                    <h4><?php echo $video->title ?></h4>
                    <p><?php echo $video->description ?></p>
                </div>
            </div>
        </div>
<?php endforeach; ?>
</div>




