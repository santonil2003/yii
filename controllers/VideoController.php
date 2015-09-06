<?php

namespace app\controllers;

use Yii;
use app\models\Video;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
use app\components\OvcRole;

/**
 * VideoController implements the CRUD actions for Video model.
 */
class VideoController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => ['view', 'index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                    return User::isUserAdmin();
                }
                    ],
                ],
                'rules' => [
                    [
                        'actions' => ['latest-videos'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                    return (User::getCurrentUserRole() == OvcRole::LECTURER);
                }
                    ],
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
     * Lists all Video models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Video::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Video model.
     * @param integer $id
     * @param integer $course_id
     * @return mixed
     */
    public function actionView($id, $course_id) {
        return $this->render('view', [
                    'model' => $this->findModel($id, $course_id),
        ]);
    }

    /**
     * Creates a new Video model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $model = new Video();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->imageFile = UploadedFile::getInstance($model, 'path');

            if ($model->upload()) {
                
            }

            return $this->redirect(['view', 'id' => $model->id, 'course_id' => $model->course_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Video model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $course_id
     * @return mixed
     */
    public function actionUpdate($id, $course_id) {
        $model = $this->findModel($id, $course_id);

        if ($model->load(Yii::$app->request->post())) {

            $model->imageFile = UploadedFile::getInstance($model, 'path');
            $path = $model->upload();

            if ($path) {
                $model->path = $path;
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'course_id' => $model->course_id]);
            }
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Video model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $course_id
     * @return mixed
     */
    public function actionDelete($id, $course_id) {
        $this->findModel($id, $course_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Video model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $course_id
     * @return Video the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $course_id) {
        if (($model = Video::findOne(['id' => $id, 'course_id' => $course_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * latestVideos
     * @return type
     */
    public function actionLatestVideos() {
        return $this->render('latest_videos');
    }

}
