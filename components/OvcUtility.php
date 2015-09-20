<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utility
 *
 * @author web.developer.sanil@gmail.com
 */

namespace app\components;

use Yii;
use yii\base\Component;
use app\components\OvcRole;

class OvcUtility extends Component {

    public function getMainNavItems() {
        $navs = array();
        $navs[] = ['label' => 'Home', 'url' => ['/site/index']];
        $navs[] = ['label' => 'About', 'url' => ['/site/about']];
        $navs[] = ['label' => 'Contact', 'url' => ['/site/contact']];

        if (Yii::$app->user->isGuest) {
            $navs[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $navs[] = ['label' => 'Logout (' . Yii::$app->user->identity->username . ')', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
        }
        return $navs;
    }

    public function getAdminNavItems() {
        $navs = array();

        $navs[0] = ['label' => 'Home', 'url' => ['/site/index'], 'linkOptions' => ['class' => 'glyphicon glyphicon-home']];
        $navs[1] = ['label' => 'About', 'url' => ['/site/about'], 'linkOptions' => ['class' => 'glyphicon glyphicon-list-alt']];
        $navs[2] = ['label' => 'Contact', 'url' => ['/site/contact'], 'linkOptions' => ['class' => 'glyphicon glyphicon-earphone']];
        $navs[3] = ['label' => 'Login', 'url' => ['/site/login'], 'linkOptions' => ['class' => 'glyphicon glyphicon-lock']];

        if (Yii::$app->user->isGuest) {
            return $navs;
        }

        unset($navs[3]);

        $User = Yii::$app->user->identity;

        switch ($User->role_id) {
            case OvcRole::ADMIN;
                $navs[] = ['label' => 'Users', 'url' => ['/user/index'], 'linkOptions' => ['class' => 'ovc-nav-separate glyphicon glyphicon-user']];
                $navs[] = ['label' => 'Courses', 'url' => ['/course/index'], 'linkOptions' => ['class' => 'glyphicon glyphicon-book']];
                $navs[] = ['label' => 'Assign Course', 'url' => ['/user-has-course/index'], 'linkOptions' => ['class' => 'glyphicon glyphicon-link']];
                $navs[] = ['label' => 'Videos', 'url' => ['/video/index'], 'linkOptions' => ['class' => 'glyphicon glyphicon-film']];
                $navs[] = ['label' => 'Comments', 'url' => ['/comment/index'], 'linkOptions' => ['class' => 'glyphicon glyphicon-comment']];
                $navs[] = ['label' => 'Logout', 'url' => ['/site/logout'], 'linkOptions' => ['class' => 'ovc-nav-separate glyphicon glyphicon-off', 'data-method' => 'post']];
                break;
            case OvcRole::LECTURER;
                $navs[] = ['label' => 'My Students', 'url' => ['/user/related-users'], 'linkOptions' => ['class' => 'ovc-nav-separate glyphicon glyphicon-user']];
                $navs[] = ['label' => 'My Courses', 'url' => ['/course/my-courses'], 'linkOptions' => ['class' => 'glyphicon glyphicon-book']];
                $navs[] = ['label' => 'Videos', 'url' => ['/video/index'], 'linkOptions' => ['class' => 'glyphicon glyphicon-film']];
                $navs[] = ['label' => 'Logout', 'url' => ['/site/logout'], 'linkOptions' => ['class' => 'ovc-nav-separate glyphicon glyphicon-off', 'data-method' => 'post']];
                break;
            case OvcRole::STUDENT;
                $navs[] = ['label' => 'Latest Videos', 'url' => ['video/latest-videos'], 'linkOptions' => ['class' => 'ovc-nav-separate glyphicon glyphicon-facetime-video']];
                $navs[] = ['label' => 'My Courses', 'url' => ['/course/my-courses'], 'linkOptions' => ['class' => 'glyphicon glyphicon-book']];
                $navs[] = ['label' => 'Videos', 'url' => ['/video/index'], 'linkOptions' => ['class' => 'glyphicon glyphicon-film']];
                $navs[] = ['label' => 'Logout', 'url' => ['/site/logout'], 'linkOptions' => ['class' => 'ovc-nav-separate glyphicon glyphicon-off', 'data-method' => 'post']];
                break;
            default:
                break;
        }

        return $navs;
    }

    /**
     * action template for grid view
     * @return string|array
     */
    public static function getCourseActionTemplate() {
        if (Yii::$app->user->isGuest) {
            return '{view}';
        }

        $User = Yii::$app->user->identity;

        switch ($User->role_id) {
            case OvcRole::ADMIN;
                return '<div class="width-50">{view}&nbsp;{update}&nbsp;{delete}</div>';
            case OvcRole::LECTURER;
                return '<div class="width-34">{view}&nbsp;{update}</div>';
            case OvcRole::STUDENT;
            default :
                return '{view}';
        }
    }

    public static function getVideoActionTemplate() {
        if (Yii::$app->user->isGuest) {
            return '{view}';
        }

        $User = Yii::$app->user->identity;

        switch ($User->role_id) {
            case OvcRole::ADMIN;
            case OvcRole::LECTURER;
                return '<div class="width-50">{view}&nbsp;{update}&nbsp;{delete}</div>';
            case OvcRole::STUDENT;
            default :
                return '{view}';
        }
    }

    public static function getCommentActionTemplate() {
        if (Yii::$app->user->isGuest) {
            return '';
        }

        $User = Yii::$app->user->identity;

        switch ($User->role_id) {
            case OvcRole::ADMIN;
            case OvcRole::LECTURER;
                return '<div class="width-34">{view}&nbsp;{delete}</div>';
            case OvcRole::STUDENT;
            default :
                return '{view}';
        }
    }

    public static function getUserHasCourseActionTemplate() {
        if (\app\components\OvcUser::isUserAdmin()) {
            return '<div class="width-50">{view}&nbsp;{update}&nbsp;{delete}</div>';
        } else {
            return '';
        }
    }

    public static function getUserActionTemplate() {
        if (\app\components\OvcUser::isUserAdmin()) {
            return '<div class="width-50">{view}&nbsp;{update}&nbsp;{delete}</div>';
        } else {
            return '';
        }
    }

    /**
     * date format
     * @param type $date
     * @return type
     */
    public static function ovcDateFormat($date) {
        return date('F j, Y, g:i a', strtotime($date));
    }

    /**
     * ago
     * @param type $time
     * @return type
     */
    public static function ago($time) {
        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

        $now = time();

        $difference = $now - strtotime($time);
        $tense = "ago";

        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        if ($difference != 1) {
            $periods[$j].= "s";
        }

        return "$difference $periods[$j] ago ";
    }

}
