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

class Utility extends Component {

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

        $navs[] = ['label' => 'Users', 'url' => ['/user/index']];
        $navs[] = ['label' => 'Courses', 'url' => ['/course/index']];
        $navs[] = ['label' => 'Assign Course', 'url' => ['/user-has-course/index']];
        $navs[] = ['label' => 'Videos', 'url' => ['/video/index']];
        $navs[] = ['label' => 'Comments', 'url' => ['/comment/index']];

        return $navs;
    }

}
