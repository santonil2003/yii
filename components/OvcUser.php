<?php

namespace app\components;

use Yii;
use yii\base\Component;

/**
 * Description of OvcRole
 *
 * @author sanil
 */
class OvcUser extends Component {

    public static function getCurrentUser() {
        return \Yii::$app->user->identity;
    }

    private static function getQuery() {
        return new \yii\db\Query();
    }

    public static function getUserIdValuePair() {
        return self::getQuery()
                        ->select('id,first_name, last_name, username')
                        ->from('user_has_course')
                        ->where(['active' => 1])
                        ->all();
    }

}
