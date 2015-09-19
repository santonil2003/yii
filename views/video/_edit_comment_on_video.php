<div class="media ovc-comment-box ovc-edit-comment" id="edit-comment-<?= $comment->id; ?>">
    <div class="media-left">
        <img src="<?= Yii::getAlias('@web'); ?>/images/user.png" alt="course" style="max-width: 45px;"/>
    </div>
    <div class="media-body">
        <p><strong class="ucfirst"><?= app\components\OvcUser::getUserFullName($currentUserId); ?></strong></p>
        <p><textarea style="width: 100%;" class="text-comment"><?= $comment->text; ?></textarea></p>
        <p class="text-right">
            <button type="button" class="btn btn-primary btn-xs save-comment" data-comment-id="<?= $comment->id; ?>">Save</button>
            <input type="hidden" class="inline-save-comment" value="<?= yii\helpers\Url::to(['comment/inline-save', 'id' => $comment->id]) ?>">
        </p>
    </div>
</div>