<?php

namespace app\components;

use Yii;
use yii\base\Component;
use app\models\User;
use app\components\OvcRole;

/**
 * Debug 
 * @package components
 * @author Sanil Shrestha <web.developer.sanil@gmail.com>
 */
class OvcCourse extends Component {

    private static function getQuery() {
        return new \yii\db\Query();
    }

    public static function getUserCourseIds($userId) {
        return self::getQuery()
                        ->select('course_id')
                        ->from('user_has_course')
                        ->where(['user_id' => $userId])
                        ->column();
    }

    public static function getUserCourses($userId) {

        $User = User::findOne($userId);

        if ($User->role_id == OvcRole::ADMIN) {
            $rows = self::getQuery()
                    ->select('id')
                    ->from('course')
                    ->column();

            return $rows;
        }

        return self::getUserCourseIds($userId);
    }

}
