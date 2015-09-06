<?php

namespace app\controllers;

class TestController extends \yii\web\Controller {

    public function actionIndex() {

        //http://www.yiiframework.com/doc-2.0/guide-security-authentication.html
        // the current user identity. Null if the user is not authenticated.
        $identity = Yii::$app->user->identity;

// the ID of the current user. Null if the user not authenticated.
        $id = Yii::$app->user->id;

// whether the current user is a guest (not authenticated)
        $isGuest = Yii::$app->user->isGuest;


        // find a user identity with the specified username.
// note that you may want to check the password if needed
        $identity = User::findOne(['username' => $username]);

// logs in the user 
        Yii::$app->user->login($identity);
// logs user out
        Yii::$app->user->logout();


        return $this->render('index');

        //return Yii::$app->runAction('video/latest', array());
    }

}
