<?php

namespace app\controllers;

use Yii;

class TestController extends \yii\web\Controller {

    public function actionIndex() {
        $msg = \app\components\OvcCourse::getUserCourses();
        return $this->render('index', ['msg' => $msg]);
    }

}
