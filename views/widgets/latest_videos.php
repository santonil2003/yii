<div class="row ovc-latest-video">
    <?php foreach ($latestVideos as $video): ?>
        <div class="col-sm-4 col-md-3">
            <div class="thumbnail">
                <?= \app\components\OvcVideoPlayerWidget::widget(['path' => $video->path, 'controls' => false, 'startTime' => '#t=00:00:01', 'cssClass' => 'player-lastest-videos']); ?>
                <div class="caption">
                    <table>
                        <tr>
                            <td style="width:50px;"><strong>Title</strong></td>
                            <td> <?= strlen($video->title) > 25 ? substr($video->title, 0, 25) . '...' : $video->title; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Course</strong></td>
                            <td>
                                <?php $course = app\models\Course::findOne($video->course_id)->name; ?>
                                <?= strlen($course) > 25 ? substr($course, 0, 25) . '...' : $course; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Date</strong></td>
                            <td>
                                <?= date("M j, Y, g:i a", strtotime($video->created_at)) ?>
                            </td>
                        </tr>
                    </table>
                    <p class=""><a class="btn btn-info btn-xs btn-block" href="<?= yii\helpers\Url::to(['video/view', 'id' => $video->id, 'course_id' => $video->course_id]) ?>">view</a></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>