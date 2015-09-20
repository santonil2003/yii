<?php

namespace app\controllers;

use Yii;
use app\models\Video;
use app\models\VideoSearch;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\OvcUser;
use app\components\OvcCourse;

/**
 * VideoController implements the CRUD actions for Video model.
 */
class VideoController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                    return OvcUser::isUserAdmin() || OvcUser::isUserLecturer();
                }
                    ],
                    [
                        'actions' => ['view', 'index', 'latest-videos', 'play', 'get-comment-by-id', 'inline-update-comment'],
                        'allow' => true,
                        'roles' => ['@'],
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
        $searchModel = new VideoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
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

        $video = Video::findOne($id);

        if (!is_object($video)) {
            throw new NotFoundHttpException('Video not found.');
        }

        $userCourseIds = OvcCourse::getUserCourseIds();

        if (!in_array($video->course_id, $userCourseIds)) {
            throw new \yii\web\ForbiddenHttpException('Insufficient privileges to access this video.');
        }

        $comments = \app\models\Comment::find()
                ->where(['video_id' => $video->id])
                ->orderBy('id DESC')
                ->all();

        return $this->render('view', [
                    'model' => $this->findModel($id, $course_id),
                    'comments' => $comments,
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

            $path = $model->upload();

            if ($path) {
                $model->path = $path;
            }

            $model->save();

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
        $video = $this->findModel($id, $course_id);
        $video->delete();
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

    /**
     * get comment on video
     * @return type
     */
    public function actionGetCommentById($id = null) {

        if (empty($id)) {
            $id = Yii::$app->request->get('id');
        }

        $comment = \app\models\Comment::findOne($id);

        echo $this->renderPartial('_comment_on_video', [
            'comment' => $comment,
            'style' => 'display:none;',
        ]);
    }

    /**
     * inline update comment
     */
    public function actionInlineUpdateComment() {
        $id = Yii::$app->request->get('id');
        $comment = \app\models\Comment::findOne($id);
        $currentUserId = \app\components\OvcUser::getCurrentUser()->id;
        echo $this->renderPartial('_edit_comment_on_video', ['comment' => $comment, 'currentUserId' => $currentUserId]);
    }

}
