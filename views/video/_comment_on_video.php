<div class="media ovc-comment-box" style="<?= $style ?>" id="comment-<?= $comment->id; ?>">
    <div class="media-left">
        <img src="<?= Yii::getAlias('@web'); ?>/images/user.png" alt="course" style="max-width: 45px;"/>
    </div>
    <div class="media-body">
        <div class="comment-action">
            <?php if (app\components\OvcUser::getCurrentUser()->id == $comment->user_id): ?>
                <span class="glyphicon glyphicon-edit comment-edit" title="edit" data-comment-id="<?= $comment->id; ?>" data-url='<?= yii\helpers\Url::to(['comment/inline-update', 'id' => $comment->id]); ?>'></span>
            <?php endif; ?>
            &nbsp;
            <?php if (app\components\OvcUser::getCurrentUser()->id == $comment->user_id || \app\components\OvcUser::isUserAdmin()): ?>
                <span class="glyphicon glyphicon-trash comment-delete" data-url='<?= yii\helpers\Url::to(['comment/delete', 'id' => $comment->id, 'video_id' => $comment->video_id]); ?>' data-comment-id='<?= $comment->id; ?>' title="trash"></span>
            <?php endif; ?>
        </div>

        <p>
            <strong class="ucfirst"><?= app\components\OvcUser::getUserFullName($comment->user_id); ?></strong>
        </p>
        <p><?= $comment->text; ?></p>
        <p class="ovc-border-up small">
            <time class="timeago" datetime="<?= date('Y-m-d\TH:i:s\Z', strtotime($comment->created_at)); ?>"></time>
        </p>
    </div>
</div>