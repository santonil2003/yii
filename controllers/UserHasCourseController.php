<?php

namespace app\controllers;

use Yii;
use app\models\UserHasCourse;
use app\models\UserHasCourseSearch;
use app\components\OvcUser;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * UserHasCourseController implements the CRUD actions for UserHasCourse model.
 */
class UserHasCourseController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                    return OvcUser::isUserAdmin();
                }
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserHasCourse models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserHasCourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserHasCourse model.
     * @param integer $user_id
     * @param integer $course_id
     * @return mixed
     */
    public function actionView($user_id, $course_id) {
        return $this->render('view', [
                    'model' => $this->findModel($user_id, $course_id),
        ]);
    }

    /**
     * Creates a new UserHasCourse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new UserHasCourse();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'course_id' => $model->course_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserHasCourse model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $user_id
     * @param integer $course_id
     * @return mixed
     */
    public function actionUpdate($user_id, $course_id) {
        $model = $this->findModel($user_id, $course_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'course_id' => $model->course_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserHasCourse model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $user_id
     * @param integer $course_id
     * @return mixed
     */
    public function actionDelete($user_id, $course_id) {
        $this->findModel($user_id, $course_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserHasCourse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param integer $course_id
     * @return UserHasCourse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $course_id) {
        if (($model = UserHasCourse::findOne(['user_id' => $user_id, 'course_id' => $course_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetUnassignedCourse($user_id) {
        
    }

}
