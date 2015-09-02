<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Debug;

class AdminController extends \yii\web\Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => ['logout', 'signup', 'about'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                    return User::isUserAdmin();
                }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

}
