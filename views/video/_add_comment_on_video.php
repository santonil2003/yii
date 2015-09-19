<div class="media ovc-comment-box">
    <div class="media-left">
        <img src="<?= Yii::getAlias('@web'); ?>/images/user.png" alt="course" style="max-width: 45px;"/>
    </div>
    <div class="media-body">
        <p><strong class="ucfirst"><?= app\components\OvcUser::getUserFullName($currentUserId); ?></strong></p>
        <p><textarea style="width: 100%;" class="text-comment" data-vido-id="<?= $videoId ?>"></textarea></p>
        <p class="text-right">
            <button type="button" class="btn btn-default btn-xs cancel-comment">Cancel</button>
            <button type="button" class="btn btn-primary btn-xs post-comment">Post</button>
            <input type="hidden" id="post-comment-action" value="<?= yii\helpers\Url::to(['comment/add-comment']) ?>">
        </p>
    </div>
</div>