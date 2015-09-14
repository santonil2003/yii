<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <?php
            echo yii\bootstrap\Carousel::widget([
                'items' => [
                    // the item contains only the image
                    '<img src="http://placehold.it/1150x250"/>',
                    // equivalent to the above
                    ['content' => '<img src="http://placehold.it/1150x250"/>'],
                    // the item contains both the image and the caption
                    [
                        'content' => '<img src="http://placehold.it/1150x250"/>',
                        'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
                        'options' => [],
                    ],
                ]
            ]);
            ?>
        </div>

    </div>
</div>
