<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\filters\AccessControl;
use app\models\User;
use app\models\Course;
use app\components\OvcRole;

/**
 * Debug 
 * @package components
 * @author Sanil Shrestha <web.developer.sanil@gmail.com>
 */
class OvcCourse extends Component {

    public function init() {
        
    }

    private static function getQuery() {
        return new \yii\db\Query();
    }

    public static function getCourseIdsByUserId($userId) {
        return self::getQuery()
                        ->select('course_id')
                        ->from('user_has_course')
                        ->where(['user_id' => $userId])
                        ->column();
    }

    public static function getUserCourseIds($userId = null) {

        if (empty($userId)) {
            $userId = \app\components\OvcUser::getCurrentUser()->id;
        }

        $User = User::findOne($userId);

        if ($User->role_id == OvcRole::ADMIN) {
            $rows = self::getQuery()
                    ->select('id')
                    ->from('course')
                    ->column();

            return $rows;
        }

        return self::getCourseIdsByUserId($userId);
    }

    /**
     * get User Courses
     * @param type $userId
     * @return type
     */
    public static function getUserCourses($userId = null) {
        if (empty($userId)) {
            $userId = \app\components\OvcUser::getCurrentUser()->id;
        }

        $userCourseIds = self::getCourseIdsByUserId($userId);
        return Course::findAll(['id' => $userCourseIds]);
    }

}
