<?php

namespace app\components;

use yii\base\Widget;
use app\components\OvcUser;
use app\components\OvcCourse;
use app\components\OvcVideo;

/**
 * Description of OvcLatestVideoWidget
 *
 * @author sanil
 */
class OvcLatestVideoWidget extends Widget {

    public $latestVideos;

    public function init() {
        parent::init();
        if ($this->latestVideos === null) {
            $User = OvcUser::getCurrentUser();
            $courseIds = OvcCourse::getUserCourseIds($User->id);
            $this->latestVideos = \app\models\Video::find()->where(['course_id' => $courseIds])->orderBy('id DESC')->limit(16)->all();
        }
    }

    /**
     * override getViewPath
     * @return type string
     */
    public function getViewPath() {
        return \Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'widgets';
    }

    public function run() {
        return $this->render('latest_videos', ['latestVideos' => $this->latestVideos]);
    }

}
