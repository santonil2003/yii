<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Video;

/**
 * VideoSearch represents the model behind the search form about `app\models\Video`.
 */
class VideoSearch extends Video {

    /**
     * related column
     * @var courseName
     */
    public $courseName;

    /**
     * virtual column
     * comment count
     * @var type 
     */
    public $commentCount;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'course_id', 'user_id'], 'integer'],
            [['title', 'description', 'path', 'created_at', 'modified_at', 'courseName', 'commentCount'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $paramss
     *
     * @return ActiveDataProvider
     */
    public function search($params) {

        $userCourseIds = \app\components\OvcCourse::getUserCourseIds();

        $commentCount = "(SELECT COUNT(*) AS nos FROM comment AS c WHERE c.video_id = video.id)";
        $query = Video::find()
                ->select("video.*, course.name, $commentCount as commentCount")
                ->innerJoin('course', '`video`.`course_id` = `course`.`id`')
                ->where(['video.course_id' => $userCourseIds]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->params['pageSize'],
            ],
        ]);


        /**
         * additional columns to be sorted
         */
        $dataProvider->sort->attributes['courseName'] = [
            'asc' => ['course.name' => SORT_ASC],
            'desc' => ['course.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['commentCount'] = [
            'asc' => ['commentCount' => SORT_ASC],
            'desc' => ['commentCount' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'video.id' => $this->id,
            'video.course_id' => $this->course_id,
            'video.user_id' => $this->user_id,
            'video.created_at' => $this->created_at,
            'video.modified_at' => $this->modified_at,
            $commentCount => $this->commentCount,
        ]);

        $query->andFilterWhere(['like', 'video.title', $this->title])
                ->andFilterWhere(['like', 'video.description', $this->description])
                ->andFilterWhere(['like', 'video.path', $this->path])
                ->andFilterWhere(['like', 'course.name', $this->courseName]);

        return $dataProvider;
    }

}
