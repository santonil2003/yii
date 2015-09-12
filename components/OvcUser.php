<?php

namespace app\components;

use Yii;
use yii\base\Component;
use \app\components\OvcRole;

/**
 * Description of OvcRole
 *
 * @author sanil
 */
class OvcUser extends Component {

    CONST INACTIVE_USER = 'Inactive';
    CONST ACTIVE_USER = 'Active';

    /**
     * get current user object
     * @return type
     */
    public static function getCurrentUser() {
        $user = \Yii::$app->user->identity;

        if (!is_object($user)) {
            Yii::$app->response->redirect(array('site/login'));
        }

        return $user;
    }

    /**
     * get query
     * @return \yii\db\Query
     */
    private static function getQuery() {
        return new \yii\db\Query();
    }

    /**
     * get user id value pair
     * @return type
     */
    public static function getUserIdValuePair() {
        return self::getQuery()
                        ->select('id,first_name, last_name, username')
                        ->from('user_has_course')
                        ->where(['active' => 1])
                        ->all();
    }

    /**
     * get current user role
     * @return boolean
     */
    public static function getCurrentUserRole() {
        $user = self::getCurrentUser();

        if (!is_object($user)) {
            return false;
        }

        return $user->role_id;
    }

    /**
     * is User Guest
     * @return type
     */
    public static function isUserGuest() {
        return Yii::$app->user->isGuest;
    }

    /**
     * is User admin
     * @return boolean
     */
    public static function isUserAdmin() {
        $user = self::getCurrentUser();

        if (!is_object($user)) {
            return false;
        }

        return ($user->role_id == '1') ? true : false;
    }

    /**
     * is user lecturer
     * @return boolean
     */
    public static function isUserLecturer() {
        $user = self::getCurrentUser();

        if (!is_object($user)) {
            return false;
        }

        return ($user->role_id == OvcRole::LECTURER) ? true : false;
    }

    /**
     * is user student
     * @return boolean
     */
    public static function isUserStudent() {
        $user = self::getCurrentUser();

        if (!is_object($user)) {
            return false;
        }

        return ($user->role_id == OvcRole::STUDENT) ? true : false;
    }

    /**
     * get active level
     * @param type $active
     * @return string
     */
    public static function getActiveLabel($active) {
        switch ($active) {
            case '0':
                return self::INACTIVE_USER;
            case '1':
                return self::ACTIVE_USER;
            default:
                return 'Unknown';
        }
    }

}
