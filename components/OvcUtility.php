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

        if (Yii::$app->user->isGuest) {
            return $navs;
        }

        $User = Yii::$app->user->identity;

        switch ($User->role_id) {
            case OvcRole::ADMIN;
                $navs[] = ['label' => 'Users', 'url' => ['/user/index'], 'linkOptions' => ['class' => 'glyphicon glyphicon-user']];
                $navs[] = ['label' => 'Courses', 'url' => ['/course/index'], 'linkOptions' => ['class' => 'glyphicon glyphicon-book']];
                $navs[] = ['label' => 'Assign Course', 'url' => ['/user-has-course/index'], 'linkOptions' => ['class' => 'glyphicon glyphicon-link']];
                $navs[] = ['label' => 'Videos', 'url' => ['/video/index'], 'linkOptions' => ['class' => 'glyphicon glyphicon-film']];
                $navs[] = ['label' => 'Comments', 'url' => ['/comment/index'], 'linkOptions' => ['class' => 'glyphicon glyphicon-comment']];
                $navs[] = ['label' => 'Logout', 'url' => ['/site/logout'], 'linkOptions' => ['class' => 'ovc-nav-logout glyphicon glyphicon-off', 'data-method' => 'post']];
                break;
            case OvcRole::LECTURER;
                $navs[] = ['label' => 'Students', 'url' => ['/user/index'], 'linkOptions' => ['class' => 'glyphicon glyphicon-user']];
                $navs[] = ['label' => 'My Courses', 'url' => ['/course/my-courses'], 'linkOptions' => ['class' => 'glyphicon glyphicon-book']];
                $navs[] = ['label' => 'All Videos', 'url' => ['/video/index'], 'linkOptions' => ['class' => 'glyphicon glyphicon-film']];
                $navs[] = ['label' => 'Logout', 'url' => ['/site/logout'], 'linkOptions' => ['class' => 'ovc-nav-logout glyphicon glyphicon-off', 'data-method' => 'post']];
                break;
            case OvcRole::STUDENT;
                $navs[] = ['label' => 'Latest Videos', 'url' => ['video/latest-videos'], 'linkOptions' => ['class' => 'glyphicon glyphicon-facetime-video']];
                $navs[] = ['label' => 'My Courses', 'url' => ['/course/my-courses'], 'linkOptions' => ['class' => 'glyphicon glyphicon-book']];
                $navs[] = ['label' => 'Videos', 'url' => ['/video/index'], 'linkOptions' => ['class' => 'glyphicon glyphicon-film']];
                $navs[] = ['label' => 'Logout', 'url' => ['/site/logout'], 'linkOptions' => ['class' => 'ovc-nav-logout glyphicon glyphicon-off', 'data-method' => 'post']];
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
                return '{view}&nbsp;{update}&nbsp;{delete}';
            case OvcRole::LECTURER;
                return '{view}&nbsp;{update}';
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
                return '{view}&nbsp;{update}&nbsp;{delete}';
            case OvcRole::LECTURER;
                return '{view}&nbsp;{update}&nbsp;{delete}';
            case OvcRole::STUDENT;
            default :
                return '{view}';
        }
    }

}
