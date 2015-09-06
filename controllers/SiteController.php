<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\components\OvcRole;
use app\components\OvcUser;
use app\components\OvcCourse;
use app\components\OvcVideo;
use app\components\OvcDebug;

class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * load appropriate dashboard
     * @return type
     */
    private function goDashboard() {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(\Yii::$app->urlManager->createUrl("site/login"));
        }

        $User = Yii::$app->user->identity;

        Yii::$app->getSession()->setFlash('success', 'Welcome back, ' . $User->first_name);
        switch ($User->role_id) {
            case OvcRole::ADMIN;
                return $this->redirect(\Yii::$app->urlManager->createUrl("user/index"));
            case OvcRole::LECTURER;
                return $this->redirect(\Yii::$app->urlManager->createUrl("site/lecturer"));
            case OvcRole::STUDENT;
                return $this->redirect(\Yii::$app->urlManager->createUrl("video/latest-videos"));
            default:
                $this->goHome();
                break;
        }
    }

    public function actionLecturer() {
        return $this->render('index');
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goDashboard();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goDashboard();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAbout() {
        return $this->render('about');
    }

}
