<?php

use app\components\OvcVideoPlayerWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Video */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$currentUserId = app\components\OvcUser::getCurrentUser()->id;
?>
<div class="row">
    <div class="col-lg-7">
<?= OvcVideoPlayerWidget::widget(['path' => $model->path, 'width' => 600]); ?>
    </div>
    <div class="col-lg-5">
        <table class="table table-bordered table-striped">
            <tr>
                <td width="100">Title</td>
                <td><?= $model->title ?></td>
            </tr>
            <tr>
                <td>Description</td>
                <td>
                    <div style="height: 104px; overflow-y: scroll;"><?= $model->description ?></div>
                </td>
            </tr>
            <tr>
                <td>Course</td>
                <td><?= app\models\Course::findOne($model->course_id)->name; ?></td>
            </tr>
            <tr>
                <td>Comments</td>
                <td><?= count(app\models\Comment::findAll(['video_id' => $model->id])) ?></td>
            </tr>
            <tr>
                <td>Uploaded By</td>
                <td><?= app\components\OvcUser::getUserFullName($model->user_id); ?></td>
            </tr>
            <tr>
                <td>Created on</td>
                <td><?= app\components\OvcUtility::ovcDateFormat($model->created_at); ?></td>
            </tr>
            <tr>
                <td>Modified on</td>
                <td><?= app\components\OvcUtility::ovcDateFormat($model->modified_at); ?></td>
            </tr>
        </table>
    </div>
</div>
<div id="debug"></div>
<h1>Comments</h1>
<hr/>
<div class="media ovc-comment-box">
    <div class="media-left">
        <img src="<?= Yii::getAlias('@web'); ?>/images/user.png" alt="course" style="max-width: 45px;"/>
    </div>
    <div class="media-body">
        <p><strong class="ucfirst"><?= app\components\OvcUser::getUserFullName($currentUserId); ?></strong></p>
        <p><textarea style="width: 100%;" class="text-comment" data-vido-id="<?= $model->id ?>"></textarea></p>
        <p class="text-right">
            <button type="button" class="btn btn-default btn-xs cancel-comment">Cancel</button>
            <button type="button" class="btn btn-primary btn-xs post-comment">Post</button>
            <input type="hidden" id="post-comment-action" value="<?= yii\helpers\Url::to(['comment/add-comment']) ?>">
        </p>
    </div>
</div>
<div class="new-comment"></div>
<?php foreach ($comments as $comment): ?>
    <?=
    $this->render('_comment_on_video', [
        'comment' => $comment,
        'style' => '',
    ]);
    ?>
<?php endforeach; ?>