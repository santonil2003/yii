<?php

namespace app\controllers;

use Yii;
use app\models\Comment;
use app\models\CommentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
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
     * Lists all Comment models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comment model.
     * @param integer $id
     * @param integer $video_id
     * @return mixed
     */
    public function actionView($id, $video_id) {
        return $this->render('view', [
                    'model' => $this->findModel($id, $video_id),
        ]);
    }

    /**
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Comment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'video_id' => $model->video_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Comment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $video_id
     * @return mixed
     */
    public function actionUpdate($id, $video_id) {
        $model = $this->findModel($id, $video_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'video_id' => $model->video_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Comment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $video_id
     * @return mixed
     */
    public function actionDelete($id, $video_id) {
        $result = $this->findModel($id, $video_id)->delete();

        if (Yii::$app->request->isAjax) {
            exit("1");
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $video_id
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $video_id) {
        if (($model = Comment::findOne(['id' => $id, 'video_id' => $video_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * add comment
     */
    public function actionAddComment() {

        if (!Yii::$app->request->isAjax) {
            throw new \yii\web\ForbiddenHttpException('Illegal Request.');
        }


        $model = new Comment();
        $model->video_id = Yii::$app->request->post('video_id');
        $model->text = Yii::$app->request->post('text');

        if ($model->save()) {
            Yii::$app->runAction('video/get-comment-by-id', ['id' => $model->id]);
        } else {
            echo '';
        }

        exit();
    }

    /**
     * inline update 
     * @param type $id
     * @param type $video_id
     */
    public function actionInlineUpdate($id) {
        Yii::$app->runAction('video/inline-update-comment', ['id' => $id]);
    }

    /**
     * inline save
     * @throws \yii\web\ForbiddenHttpException
     */
    public function actionInlineSave() {

        $id = Yii::$app->request->post('id');

        $model = Comment::findOne($id);

        if (!Yii::$app->request->isAjax || !is_object($model)) {
            throw new \yii\web\ForbiddenHttpException('Illegal Request.');
        }

        $model->text = Yii::$app->request->post('text');

        if ($model->save()) {
            Yii::$app->runAction('video/get-comment-by-id', ['id' => $model->id]);
        }
    }

}
