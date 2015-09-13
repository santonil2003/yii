<div class="media ovc-comment-box" style="<?= $style ?>">
    <div class="media-left">
        <img src="<?= Yii::getAlias('@web'); ?>/images/user.png" alt="course" style="max-width: 45px;"/>
    </div>
    <div class="media-body">
        <p><strong class="ucfirst"><?= app\components\OvcUser::getUserFullName($comment->user_id); ?></strong></p>
        <p><?= $comment->text; ?></p>
        <p class="ovc-border-up">
            <span><?php //app\components\OvcUtility::ago($comment->created_at);      ?></span>
            <time class="timeago" datetime="<?= date('Y-m-d\TH:i:s\Z', strtotime($comment->created_at)); ?>"></time>
        </p>
    </div>
</div>