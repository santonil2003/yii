<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
            case 1: // admin
                return $this->redirect(\Yii::$app->urlManager->createUrl("admin/index"));
            case 2: // lecturer
                return $this->redirect(\Yii::$app->urlManager->createUrl("site/dashboard"));
            case 3: // student
                return $this->redirect(\Yii::$app->urlManager->createUrl("site/dashboard"));
            default:
                $this->goHome();
                break;
        }
    }

    public function actionDashboard() {
        $this->layout = 'leftCol';
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
