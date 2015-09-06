<?php

namespace app\components;

use Yii;
use yii\base\Component;

/**
 * Debug 
 * @package components
 * @author Sanil Shrestha <web.developer.sanil@gmail.com>
 */
class OvcVideo extends Component {

    private static function getQuery() {
        return new \yii\db\Query();
    }

    public static function getLatestVideosByCourseIds($courseIds) {
        return \app\models\Video::findAll(['course_id' => $courseIds]);
    }

}
