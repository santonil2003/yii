
<div data-example-id="media-alignment" class="ovc-tab-body">
    <div class="media">
        <div class="media-left">
            <img src="<?= Yii::getAlias('@web'); ?>/images/course.png" alt="course" style="max-width: 75px;"/>
        </div>
        <div class="media-body">
            <table class="table  table-striped">
                <tr>
                    <td style="width:100px"><strong>Name</strong></td>
                    <td><?= $course->name; ?></td>
                </tr>
                <tr>
                    <td valign="top"><strong>Description</strong></td>
                    <td><?= $course->description; ?></td>
                </tr>
                <tr>
                    <td><strong>Created at</strong></td>
                    <td>
                        <?= date("M j, Y, g:i a", strtotime($course->created_at)) ?>
                    </td>
                </tr>
            </table>


            <p class="text-right">
                <?php
                echo yii\helpers\Html::a('Videos', ['video/index', 'VideoSearch[courseName]' => $course->name], ['class' => 'btn btn-primary btn-xs']);
                ?>
            </p>
        </div>
    </div>
</div>
