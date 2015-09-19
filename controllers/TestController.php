<?php

namespace app\controllers;

use Yii;

class TestController extends \yii\web\Controller {

    public function actionIndex() {
        $courseIds = \app\components\OvcCourse::getUserCourseIds();
        $msg = \app\components\OvcUser::getUserIdsByCourseIds($courseIds);
        return $this->render('index', ['msg' => $msg]);
    }

}
