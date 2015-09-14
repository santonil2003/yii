<div class="ovc-latest-video">
    <?php
    $items = [];
    $count = 0;
    foreach ($latestVideos as $video):
        $item = [];
        ob_start();
        ?>
        <div data-example-id="media-alignment" class="">
            <div class="media">
                <div class="media-left">
                    <?= \app\components\OvcVideoPlayerWidget::widget(['path' => $video->path, 'width' => 200]); ?>
                </div>
                <div class="media-body">
                    <h4><?= $video->title; ?></h4>
                    <?= $video->description; ?>
                    <p class="text-right"> <a class="btn btn-primary btn-xs" href="<?= yii\helpers\Url::to(['video/view', 'id' => $video->id, 'course_id' => $video->course_id]) ?>">view</a></p>
                </div>
            </div>
        </div>
        <?php
        $item['label'] = $video->title;
        $item['content'] = ob_get_clean();

        if ($count == 0) {
            $item['contentOptions'] = ['class' => 'in'];
        }

        array_push($items, $item);
        $count++;

    endforeach;

    echo yii\bootstrap\Collapse::widget(['items' => $items]);
    ?>
</div>
